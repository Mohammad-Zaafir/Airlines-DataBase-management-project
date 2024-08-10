<?php
// Include the TCPDF library
require_once('tcpdf/tcpdf.php');

// Include the database connection file
include 'connect.php';

// Check if the ticket number is provided
if(isset($_POST['ticket_number'])) {
    // Retrieve ticket information from the database
    $ticket_number = $_POST['ticket_number'];
    $sql = "SELECT * FROM booking_process WHERE ticket_number = '$ticket_number'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // Ticket found, fetch data
        $row = $result->fetch_assoc();
        $flight_id = $row['f_id'];
        $user_id = $row['u_id'];
        $passenger_name = $row['passenger_name'];
        $passenger_email = $row['passenger_email'];
        $seat_number = $row['seat_number'];
        $payment_amount = $row['payment_amount'];

        // Create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Ticket');
        $pdf->SetSubject('Ticket');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add company name and logo
        $pdf->Image('M n zEE (1)_adobe_express.png', 170, 10, 30, 30, 'PNG'); // Adjusted coordinates for the top-right corner

        // Add ticket information in a table with custom styles
        $html = '
            <h1 style="text-align:center; margin-bottom: 20px; font-size: 24px;">Boarding Pass</h1>
            <table cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse; border: 2px solid #007bff;">
                <tr style="background-color:#007bff; color:white;">
                    <th style="padding: 10px;">Field</th>
                    <th style="padding: 10px;">Value</th>
                </tr>
                <tr>
                    <td><strong>Ticket Number</strong></td>
                    <td>' . $ticket_number . '</td>
                </tr>
                <tr>
                    <td><strong>Flight ID</strong></td>
                    <td>' . $flight_id . '</td>
                </tr>
                <tr>
                    <td><strong>User ID</strong></td>
                    <td>' . $user_id . '</td>
                </tr>
                <tr>
                    <td><strong>Passenger Name</strong></td>
                    <td>' . $passenger_name . '</td>
                </tr>
                <tr>
                    <td><strong>Passenger Email</strong></td>
                    <td>' . $passenger_email . '</td>
                </tr>
                <tr>
                    <td><strong>Seat Number</strong></td>
                    <td>' . $seat_number . '</td>
                </tr>
                <tr>
                    <td><strong>Payment Amount</strong></td>
                    <td>' . $payment_amount . '</td>
                </tr>
            </table>
        ';

        // Write the HTML content to the PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF as attachment
        $pdf->Output('ticket.pdf', 'D');

        // Close the connection
        $con->close();
    } else {
        // Ticket not found
        echo "Ticket not found.";
    }
} else {
    // Ticket number not provided
    echo "Ticket number not provided.";
}
?>
