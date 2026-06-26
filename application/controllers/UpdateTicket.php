<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateTicket extends CI_Controller {
    public function index()
    {
        $title['title'] = "Update Tiket";
        session_start();
        $role = strtolower((string)($_SESSION['role'] ?? ''));
        if (
            isset($_SESSION['role']) && (
                $role == 'superadmin' ||
                $role == 'noc ritel' ||
                $role == 'team leader' ||
                $role == 'pemeliharaan ritel' ||
                $role == 'guest 1' ||
                $role == 'admin mitra'
            )
        ) {
            $this->load->view('navbar', $title);
            $this->load->view('updateTicket');
        } else {
            header('location: ./DashboardNoc');
        }
    }

    public function search()
    {
        $incident = trim($this->input->post('incident'));

        if ($incident === '') {
            echo '<div class="alert alert-warning">Incident wajib diisi.</div>';
            return;
        }

        $incidentEscaped = $this->db->escape_str($incident);

        $ticket = $this->db->query(
            "SELECT * FROM tiket WHERE idInsiden = '" . $incidentEscaped . "' OR idTiket = '" . $incidentEscaped . "' LIMIT 1"
        )->row_array();

        if (!$ticket) {
            echo '<div class="alert alert-warning">Incident <strong>' . htmlspecialchars($incident) . '</strong> tidak ditemukan.</div>';
            return;
        }

        $team = $ticket['tim'];
        $teamEscaped = $this->db->escape_str($team);

        $query = $this->db->query(
            "SELECT idInsiden, idTiket, status, keluhan, keterangan, tanggal, prioritas, tim
            FROM tiket
            WHERE tim = '" . $teamEscaped . "'
            ORDER BY tanggal ASC"
        )->result_array();

        $queueRows = [];
        $position = null;
        $currentStatus = null;
        $details = $ticket;
        $queueIndex = 0;
        $normalizedIncident = trim($incident);
        $currentProgressIncident = null;

        foreach ($query as $row) {
            $statusUpper = strtoupper(trim($row['status']));
            $isOpen = !in_array($statusUpper, ['CLOSED', 'SOLVED (ICRM OPEN)'], true);

            if ($isOpen) {
                $queueIndex++;
                $row['queue'] = $queueIndex;
                $queueRows[] = $row;
            }

            if ($currentProgressIncident === null && stripos($statusUpper, 'PROGRESS') !== false) {
                $currentProgressIncident = trim((string)$row['idInsiden']);
            }

            $rowIncident = trim((string)$row['idInsiden']);
            $rowTicket = trim((string)$row['idTiket']);
            if ($rowIncident === $normalizedIncident || $rowTicket === $normalizedIncident) {
                $currentStatus = $statusUpper;
                if ($isOpen) {
                    $position = $queueIndex;
                }
            }
        }

        echo '<div class="card mb-3"><div class="card-body">';
        echo '<h5 class="card-title mb-3">List Antrian Tim: <strong>' . htmlspecialchars($team) . '</strong></h5>';
        echo '<div class="list-group mb-3">';
        foreach ($queueRows as $row) {
            echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
            echo '<span>' . htmlspecialchars($row['idInsiden']) . '</span>';
            echo '<span class="badge bg-primary">Antrian ' . $row['queue'] . '</span>';
            echo '</div>';
        }
        echo '</div>';

        if ($currentStatus === null) {
            echo '<div class="alert alert-warning">Incident <strong>' . htmlspecialchars($incident) . '</strong> sudah ditutup atau tidak berada di daftar antrian tim <strong>' . htmlspecialchars($team) . '</strong>.</div>';
        } else {
            $detailsIncident = trim((string)$details['idInsiden']);
            if ($detailsIncident === '') {
                $detailsIncident = $incident;
            }

            if ($currentProgressIncident !== null) {
                $statusText = 'saat ini tim masih mengerjakan Incident ' . htmlspecialchars($currentProgressIncident);
                echo '<div class="alert alert-success mb-3">';
                echo 'Antrian ke <strong>' . ($position !== null ? $position : 'tidak dalam queue') . '</strong>, ' . $statusText;
                echo '</div>';
            } else {
                echo '<div class="alert alert-warning mb-3">Tidak ditemukan incident yang sedang di progress</div>';
            }

            echo '<div class="mb-2"><strong>Tim:</strong> ' . htmlspecialchars($team) . '</div>';
            echo '<div class="mb-2"><strong>ID Incident:</strong> ' . htmlspecialchars($detailsIncident) . '</div>';
            echo '<div><strong>Detail:</strong> ' . htmlspecialchars(trim($details['keluhan'] . ' ' . $details['keterangan'])) . '</div>';
        }

        echo '</div></div>';
    }
}
