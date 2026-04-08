#!/usr/bin/env python3
from pathlib import Path

path = Path('application/views/monitoring_tim_serpo.php')
text = path.read_text()

# The old pattern with escaped newlines
old = '''<div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-dark py-1 fs-7">Feeder ' + feederPending + '</span>
                                    <span class="badge bg-light text-dark py-1 fs-7">IKR ' + retailPending + '</span>
                                    <span class="badge bg-light text-dark py-1 fs-7">Corporate ' + corporatePending + '</span>
                                </div>
                                <div class="d-flex flex-wrap gap-1 mt-2">
                                    ' + (feederOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">Feeder On Progress</span>' : (feederPending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Feeder Pending</span>' : '')) +
                                    ' ' + (retailOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">IKR On Progress</span>' : (retailPending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">IKR Pending</span>' : '')) +
                                    ' ' + (corporateOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">Corporate On Progress</span>' : (corporatePending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Corporate Pending</span>' : '')) +
                                </div>'''

new = '''<div class="d-flex justify-content-between align-items-center mb-1 gap-1">
                                    <span class="badge bg-light text-dark py-1 fs-7">Feeder ' + feederPending + '</span>
                                    <span>' + (feederOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">On Progress</span>' : (feederPending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Pending</span>' : '')) + '</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1 gap-1">
                                    <span class="badge bg-light text-dark py-1 fs-7">IKR ' + retailPending + '</span>
                                    <span>' + (retailOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">On Progress</span>' : (retailPending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Pending</span>' : '')) + '</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center gap-1">
                                    <span class="badge bg-light text-dark py-1 fs-7">Corporate ' + corporatePending + '</span>
                                    <span>' + (corporateOnprogress > 0 ? '<span class="badge bg-info text-white py-1 fs-7">On Progress</span>' : (corporatePending > 0 ? '<span class="badge bg-danger text-white py-1 fs-7">Pending</span>' : '')) + '</span>
                                </div>'''

if old in text:
    text = text.replace(old, new)
    path.write_text(text)
    print("SUCCESS: Badges layout updated")
else:
    print("Pattern not found")
    # Try to debug
    import re
    matches = re.findall(r'd-flex flex-wrap', text)
    print(f"Found {len(matches)} pattern matches")
