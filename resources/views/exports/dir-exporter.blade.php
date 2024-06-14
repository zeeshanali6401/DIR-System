<table>
    <thead>
        <tr>
            <th>Case ID</th>
            <th>Caller Phone</th>
            <th>Case Date Time</th>
            <th>Time</th>
            <th>PS</th>
            <th>Case Nature</th>
            <th>Location</th>
            <th>Case Description</th>
            <th>Camera ID</th>
            <th>Evidence</th>
            <th>CRO</th>
            <th>Face Trace</th>
            <th>ANPR Passing</th>
            <th>Finding Remarks</th>
            <th>Team</th>
            <th>Culprit</th>
            <th>FIR Number</th>
            <th>Feedback</th>
            <th>Shift</th>
            <th>Division</th>
            <th>PCO Names</th>
            <th>User ID</th>
            <th>User IP</th>
            <th>User Hostname</th>
            <th>Status</th>
            <th>User Email</th>
            <th>Field Force</th>
            <th>Local Cameras</th>
            <th>Gang Name</th>
            <th>Supervisor ID</th>
            <th>PCO ID</th>
            <th>Created_at</th>
            <th>Updated_at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dirs as $dir)
            <tr>
                <td>{{ $dir->case_id }}</td>
                <td>{{ $dir->caller_phone }}</td>
                <td>{{ $dir->case_date_time }}</td>
                <td>{{ $dir->time }}</td>
                <td>{{ $dir->ps }}</td>
                <td>{{ $dir->case_nature }}</td>
                <td>{{ $dir->location }}</td>
                <td>{{ $dir->case_description }}</td>
                <td>{{ $dir->camera_id }}</td>
                <td>{{ $dir->evidence }}</td>
                <td>{{ $dir->cro }}</td>
                <td>{{ $dir->face_trace }}</td>
                <td>{{ $dir->anpr_passing }}</td>
                <td>{{ $dir->finding_remarks }}</td>
                <td>{{ $dir->team }}</td>
                <td>{{ $dir->culprit }}</td>
                <td>{{ $dir->fir_number }}</td>
                <td>{{ $dir->feedback }}</td>
                <td>{{ $dir->shift }}</td>
                <td>{{ $dir->division }}</td>
                <td>{{ $dir->pco_names }}</td>
                <td>{{ $dir->user_id }}</td>
                <td>{{ $dir->user_ip }}</td>
                <td>{{ $dir->user_hostname }}</td>
                <td>{{ $dir->status }}</td>
                <td>{{ $dir->user_email }}</td>
                <td>{{ $dir->field_force }}</td>
                <td>{{ $dir->local_cameras }}</td>
                <td>{{ $dir->gang_name }}</td>
                <td>{{ $dir->supervisor_id }}</td>
                <td>{{ $dir->pco_id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
