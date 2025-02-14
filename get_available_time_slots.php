<?php
// Include your database connection
use Classes\DbConnector;
require 'vendor\autoload.php';

$db = new DbConnector();
$conn = $db->getConnection();

if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Fetch available time slots and their booking counts for the selected date
    $query = "SELECT appointment_time, COUNT(*) AS booked_slots FROM appointment WHERE appinment_date = ? GROUP BY appointment_time";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $selectedDate);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $timeSlots = array();

    // Assuming appointment_time corresponds to the values 1, 2, 3
    $totalSlots = 3; // Total number of time slots

    // Initialize time slots array with default availability (not booked)
    for ($i = 1; $i <= $totalSlots; $i++) {
        $timeSlots[$i] = array(
            'id' => $i,
            'slotLabel' => getTimeSlotLabel($i),
            'booked_slots' => 0
        );
    }

    // Update availability for booked time slots
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $timeSlot = intval($row['appointment_time']);
        if (array_key_exists($timeSlot, $timeSlots)) {
            $timeSlots[$timeSlot]['booked_slots'] = intval($row['booked_slots']);
        }
    }

    // Convert the array to JSON and send the response
    header('Content-Type: application/json');
    echo json_encode(array_values($timeSlots)); // Reset array keys for JSON object
}

// Function to get time slot labels based on appointment_time values
function getTimeSlotLabel($timeSlot): string
{
    switch ($timeSlot) {
        case 1:
            return '8.00 A.M - 10.00 A.M';
        case 2:
            return '10.00 A.M - 12.00 P.M';
        case 3:
            return '1.00 P.M - 3.00 P.M';
        default:
            return 'Unknown';
    }
}
?>
