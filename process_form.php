<?php
    try {
        require 'assets/fpdf/fpdf.php';
        require 'assets/db/db_connection.php';
        require 'assets/vendor/autoload.php';

        // use PHPMailer\PHPMailer\PHPMailer;
        // use PHPMailer\PHPMailer\Exception;

        function generatePDF($data) {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);

            $pdf->Cell(0, 10, 'Lead Generation Form', 0, 1, 'C');
            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(40, 10, 'Field', 1);
            $pdf->Cell(100, 10, 'Value', 1);
            $pdf->Ln();

            $pdf->SetFont('Arial', '', 12);
            foreach ($data as $key => $value) {
                $pdf->Cell(40, 10, ucfirst(str_replace('_', ' ', $key)), 1);
                $pdf->Cell(100, 10, $value, 1);
                $pdf->Ln();
            }

            $pdf_path = 'submission.pdf';
            if (file_exists($pdf_path)) {
                unlink($pdf_path);
            }
            $pdf->Output($pdf_path, 'F');
        }

        function insertFormData($data) {
            global $conn;

            $columns = implode(", ", array_keys($data));
            $values = "'" . implode("', '", $data) . "'";

            $sql = "INSERT INTO mortgage_leads ($columns) VALUES ($values)";

            if ($conn->query($sql) === TRUE) {
                return;
            } else {
                throw new Exception("Error inserting data into database: " . $conn->error);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            function sanitizeInput($input)
            {
                return htmlspecialchars(trim($input));
            }

            $full_name                  = sanitizeInput($_POST['full_name']);
            $email_address              = sanitizeInput($_POST['email_address']);
            $phone_number               = sanitizeInput($_POST['phone_number']);
            $street_address             = sanitizeInput($_POST['street_address']);
            $unit                       = sanitizeInput($_POST['unit']);
            $zip_code                   = sanitizeInput($_POST['zip_code']);

            $property_type              = sanitizeInput($_POST['property_type']);
            $loan_type                  = sanitizeInput($_POST['loan_type']);
            $mortgage_goal              = sanitizeInput($_POST['mortgage_goal']);
            $value_property             = sanitizeInput($_POST['value_property']);
            $loan_balance               = sanitizeInput($_POST['loan_balance']);
            $current_interest_rate      = sanitizeInput($_POST['current_interest_rate']);
            $property_ownership         = sanitizeInput($_POST['property_ownership']);
            $property_use               = sanitizeInput($_POST['property_use']);
            $military_service           = isset($_POST['military_service']) ? 1 : 0;

            $bank_customer_options = [
                '1' => 'Chase', 
                '2' => 'Bank of America', 
                '3' => 'Wells Fargo', 
                '4' => 'Citibank, NA', 
                '5' => 'US Bank', 
                '6' => 'PNC Bank', 
                '7' => 'Navy Federal Credit Union'
            ];
            
            $selected_bank_customers = [];
            
            foreach ($bank_customer_options as $key => $option) {
                $checkboxName = 'bank_customer_' . $key;
            
                if (isset($_POST[$checkboxName])) {
                    $selected_bank_customers[] = sanitizeInput($option);
                }
            }
            
            $bank_customer = implode(', ', $selected_bank_customers);
            
            if (isset($_POST['bank_customer_none'])) {
                $noneOfTheAbove = sanitizeInput('None of the Above');
                $bank_customer .= $bank_customer ? ", $noneOfTheAbove" : $noneOfTheAbove;
            }
            

            $employment_status          = sanitizeInput($_POST['employment_status']);
            $household_income           = sanitizeInput($_POST['household_income']);
            $bankruptcy_foreclosure     = isset($_POST['bankruptcy_foreclosure']) ? 1 : 0;
            $cash_out_amount            = sanitizeInput($_POST['cash_out_amount']);
            $credit_score               = sanitizeInput($_POST['credit_score']);
            $companyID                  = sanitizeInput($_POST['companyID']);
            if ($companyID == 'sentridocs'){
                $companyID == 0;
            }
            $companySlug                = sanitizeInput($_POST['companySlug']);

            $formData = [
                'full_name'                 => $full_name,
                'email_address'             => $email_address,
                'phone_number'              => $phone_number,
                'street_address'            => $street_address,
                'unit'                      => $unit,
                'zip_code'                  => $zip_code,

                'property_type'             => $property_type,
                'loan_type'                 => $loan_type,
                'mortgage_goal'             => $mortgage_goal,
                'value_property'            => $value_property,
                'loan_balance'              => $loan_balance,
                'current_interest_rate'     => $current_interest_rate,
                'property_ownership'        => $property_ownership,
                'property_use'              => $property_use,
                'military_service'          => $military_service,
                'bank_customer'             => $bank_customer,
                'employment_status'         => $employment_status,
                'household_income'          => $household_income,
                'bankruptcy_foreclosure'    => $bankruptcy_foreclosure,
                'cash_out_amount'           => $cash_out_amount,
                'credit_score'              => $credit_score,
                'company_id'                => $companyID
            ];

            insertFormData($formData);
            // generatePDF($formData);
            
            echo '<script>';
            echo 'alert("Form Submitted Successfully");';
            echo 'window.location.href = "https://sentridocs.com/' . $companySlug . '/loan-officer.php";';
            echo '</script>';
        }
    }catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        echo '<script>';
        echo 'alert("An error occurred while processing your request. Please try again later.");';
        echo 'window.location.href = "https://sentridocs.com/' . $companySlug . '/loan-officer.php";';
        echo '</script>';
    }
    // generatePDF($formData);
    // $mail = new PHPMailer(true);
    // try {

    //     $mail->isSMTP();
    //     $mail->Host = $smtpHost;
    //     $mail->SMTPAuth = $smtpAuth;
    //     $mail->Username = $smtpUsername;
    //     $mail->Password = $smtpPassword;
    //     $mail->SMTPSecure = $smtpSecure;
    //     $mail->Port = $smtpPort;

    //     $mail->setFrom('sender@example.com', 'Sender Name');
    //     $mail->addAddress('receiver@example.com', 'Recipient Name');

    //     $pdf_path = 'submission.pdf';
    //     $mail->addAttachment($pdf_path);

    //     $mail->isHTML(true);
    //     $mail->Subject = 'Lead Generation Form Attachment';
    //     $mail->Body = 'Please find the attached PDF for the form submission.';

    //     $mail->send();
    //     echo '<script>';
    //     echo 'alert("Form Submitted Successfully");';
    //     echo 'window.location.href = "https.sentridocs.com/' . $companySlug . '/loan-officer.php";';
    //     echo '</script>';
        
    // } catch (Exception $e) {
        // echo 'Error in sending email: ' . $mail->ErrorInfo;
    // }

$conn->close();
?>
