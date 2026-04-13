<?php
require_once 'Pdo_methods.php';

class Date_time {

    private $pdo;

    public function __construct() {
        $this->pdo = new PdoMethods();
    }

    public function checkSubmit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return '';
        }

        if (isset($_POST['addNote'])) {
            return $this->addNote();
        }

        if (isset($_POST['getNotes'])) {
            return $this->displayNotes();
        }

        return '';
    }

    private function addNote() {
        $dateTime = isset($_POST['dateTime']) ? trim($_POST['dateTime']) : '';
        $note = isset($_POST['note']) ? trim($_POST['note']) : '';

        if ($dateTime === '' || $note === '') {
            return $this->createAlert("Must enter date, time, and note", "danger");
        }

        $timestamp = strtotime($dateTime); /* Conversion */ 

        if ($timestamp === false) {
            return $this->createAlert("Must enter date, time, and note", "danger");
        }

        $sql = "INSERT INTO note (date_time, note) VALUES (:date_time, :note)";
        $bindings = [
            [':date_time', $timestamp, 'int'],
            [':note', $note, 'str']
        ];

        $result = $this->pdo->otherBinded($sql, $bindings);

        if ($result === 'noerror') {
            return $this->createAlert("Note added successfully", "success");
        }

        return $this->createAlert("There was an error adding the note", "danger");
    }

    private function displayNotes() {
        $begDate = isset($_POST['begDate']) ? trim($_POST['begDate']) : ''; /* Input */
        $endDate = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';

        if ($begDate === '' || $endDate === '') {
            return $this->createAlert("No notes found for date range selected", "danger");
        }

        $begTimestamp = strtotime($begDate . " 00:00:00");
        $endTimestamp = strtotime($endDate . " 23:59:59"); 

        if ($begTimestamp === false || $endTimestamp === false || $begTimestamp > $endTimestamp) /* Validation */ {
            return $this->createAlert("No notes found for date range selected", "danger");
        }

        $sql = "SELECT date_time, note
                FROM note
                WHERE date_time BETWEEN :begDate AND :endDate /* Query */
                ORDER BY date_time DESC";

        $bindings = [
            [':begDate', $begTimestamp, 'int'],
            [':endDate', $endTimestamp, 'int']
        ];

        $records = $this->pdo->selectBinded($sql, $bindings);

        if ($records === 'error' || empty($records)) {
            return $this->createAlert("No notes found for date range selected", "danger");
        }

        return $this->buildTable($records); /* Display */
    }

    private function buildTable($records) {
        $table = '<table class="table table-bordered table-striped">';
        $table .= '<thead><tr><th>Date and Time</th><th>Note</th></tr></thead><tbody>';

        foreach ($records as $row) {
            $formattedDate = date("m/d/Y h:i a", $row['date_time']);
            $safeNote = htmlspecialchars($row['note'], ENT_QUOTES, 'UTF-8');

            $table .= "<tr>
                        <td>{$formattedDate}</td>
                        <td>{$safeNote}</td>
                       </tr>";
        }

        $table .= '</tbody></table>';

        return $table;
    }

    private function createAlert($msg, $type) {
        return "<div class='alert alert-{$type}' role='alert'>{$msg}</div>";
    }
}
?>