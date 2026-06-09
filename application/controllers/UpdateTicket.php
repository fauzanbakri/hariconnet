<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateTicket extends CI_Controller {
    public function index()
    {
        $title['title'] = "Update Tiket";
        session_start();
        if (
            isset($_SESSION['role']) && (
                $_SESSION['role'] == 'Superadmin' ||
                $_SESSION['role'] == 'NOC Ritel' ||
                $_SESSION['role'] == 'Team Leader' ||
                $_SESSION['role'] == 'Pemeliharaan Ritel' ||
                $_SESSION['role'] == 'Guest 1'
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
        $tim = trim($this->input->post('tim'));
        $incident = trim($this->input->post('incident'));

        if ($tim === '' || $incident === '') {
            echo '<div class="alert alert-warning">Tim dan Incident wajib diisi.</div>';
            return;
        }

        $timEscaped = $this->db->escape_str($tim);
        $incidentEscaped = $this->db->escape_str($incident);

        $query = $this->db->query(
            "SELECT idInsiden, idTiket, status, keluhan, keterangan, tanggal, prioritas
            FROM tiket
            WHERE tim = '" . $timEscaped . "'
            ORDER BY
                CASE
                    WHEN status = 'NEW' THEN 1
                    WHEN status = 'OPEN' THEN 2
                    WHEN status = 'ON PROGRESS' THEN 3
                    WHEN status = 'EARLY' THEN 4
                    WHEN status = 'SOLVED (ICRM OPEN)' THEN 5
                    WHEN status = 'CLOSED' THEN 6
                    ELSE 7
                END,
                prioritas,
                tanggal ASC"
        )->result_array();

        $queueRows = [];
        $position = null;
        $currentStatus = null;
        $details = null;
        $queueIndex = 0;

        foreach ($query as $row) {
            $statusUpper = strtoupper(trim($row['status']));
            $isOpen = !in_array($statusUpper, ['CLOSED', 'SOLVED (ICRM OPEN)'], true);

            if ($isOpen) {
                $queueIndex++;
                $row['queue'] = $queueIndex;
                $queueRows[] = $row;
            }

            if ($row['idInsiden'] === $incidentEscaped || $row['idTiket'] === $incidentEscaped) {
                $currentStatus = $statusUpper;
                $details = $row;
                if ($isOpen) {
                    $position = $queueIndex;
                }
            }
        }

        if (empty($queueRows)) {
            echo '<div class="alert alert-info">Tidak ada antrian untuk tim <strong>' . htmlspecialchars($tim) . '</strong>.</div>';
            return;
        }

        echo '<div class="card mb-3"><div class="card-body">';
        echo '<h5 class="card-title mb-3">List Antrian Tim</h5>';
        echo '<div class="list-group mb-3">';
        foreach ($queueRows as $row) {
            echo '<div class="list-group-item d-flex justify-content-between align-items-center">';
            echo '<span>' . htmlspecialchars($row['idInsiden']) . '</span>';
            echo '<span class="badge bg-primary">Antrian ' . $row['queue'] . '</span>';
            echo '</div>';
        }
        echo '</div>';

        if ($currentStatus === null) {
            echo '<div class="alert alert-warning">Incident <strong>' . htmlspecialchars($incident) . '</strong> tidak ditemukan di dalam list tim <strong>' . htmlspecialchars($tim) . '</strong>.</div>';
        } else {
            if ($position !== null) {
                $statusText = 'saat ini tim masih progress';
            } else {
                $statusText = 'status saat ini: ' . htmlspecialchars($currentStatus);
            }

            echo '<div class="alert alert-success mb-3">';
            echo 'Antrian ke <strong>' . ($position !== null ? $position : 'tidak dalam queue') . '</strong>, ' . $statusText;
            echo '</div>';

            echo '<div class="mb-2"><strong>ID Incident:</strong> ' . htmlspecialchars($incident) . '</div>';
            echo '<div><strong>Detail:</strong> ' . htmlspecialchars(trim($details['keluhan'] . ' ' . $details['keterangan'])) . '</div>';
        }

        echo '</div></div>';
    }
}
