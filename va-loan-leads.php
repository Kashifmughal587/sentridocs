<?php
    include 'assets/db/db_connection.php';

    if(isset($_GET['company_id'])){
        $company_slug = $_GET['company_id'];

        $query = "SELECT * FROM companies WHERE company_slug = '$company_slug'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $company_details = $result->fetch_assoc();
        } else {
            echo '<script>alert("Company not found!");</script>';
            echo '<script>window.location.href = "https://sentridocs.com/";</script>';
        }

        $conn->close();
    }    
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>VA Loan Lead Form</title>
    <?php 
        if(!empty($company_details['company_fav'])) {
            echo '<link rel="shortcut icon" href="/'.$company_details['company_fav'].'" type="image/x-icon">"';
        }else{
            echo '<link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">"';
        }
    ?>
    <link rel="shortcut icon" href="'$com'" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link
		href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
		rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="assets/css/vastyle.css">
</head>

<body>
	<div>
		<main>
            <section class="funnel-box-section">
				<header class="funnel-box-header">
					<div class="header__logo">
                        <?php 
                            if(!empty($company_details['company_logo'])) {
                                echo '<img class="logo_img" src="'.$company_details['company_logo'].'" alt="Company Logo" style="max-width: 200px;">';
                            } else {
                                echo '<img class="logo_img" src="assets/img/logo-dark.png" alt="Company Logo" style="max-width: 200px;">';
                            }
                        ?>
					</div>
					<div class="funnel-box-header__info">
						<!--If company name is active and used as logo then the company name will not be displayed on right side name will be displayed on right side -->

						<span class="contact-number ">
                            <?php
                                if(!empty($company_details['company_contact']))
                                {    
                            ?>
                                <span class="cta-phone-number"
                                    style="font-family: Montserrat;font-style: normal;font-size: 16px; font-weight: 800;color: rgba(255, 197, 40, 1.00);">
                                Call Today! </span>
                            <?php
                                echo '<a class="phone-number" href="tel:"'. $company_details['company_contact'] .' style="font-family: Montserrat;font-style: normal;font-size: 16px; font-weight: 400;color: rgba(0, 0, 0, 1.00);">'.$company_details['company_contact'].'</a>';
                                }
                            ?>
						</span>
					</div>
				</header>
				<form class="funnel-box">
					<fieldset class="funnel-content-section">
						<h1 class="cta-message-heading text-center fw-normal mb-4"
							style="font-family: Roboto; font-size:21px; color: rgba(255, 197, 40, 1.00);line-height:1.5;">
							No PMI &amp; Lower Monthly Payments.</h1>
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Check Your&nbsp;</strong>
								<strong style="color: rgb(26, 188, 156);">VA Loan Eligibility</strong>
								<strong>&nbsp;with a
									Highly-Rated Local VA Loan
									Specialist</strong>
								</span>
							</h1>
							<div class="question-description-text ">
								<p class="text-white fw-bold">Are you looking to buy or refinance?</p>
							</div>
						</div>
						<div class="images-answer-section">
							<div class="images-answer-row ">
								<div class="images-answer-col">
									<div class="images-answer-block">
										<label class="image-answer-label">
											<input type="radio" name="image_33" value="I want to buy a home"
												class="image-answer-checkbox" required="">
											<span class="selection-check"></span>
											<div class="image-holder" style="border-radius: 12px">
												<div class="image-wrap">
													<img src="https://images.lp-images1.com/images1/1/17344//pics/image_1691618130.png"
														alt="">
												</div>
											</div>
											<div class="image-answer-caption" style="color: rgba(0, 16, 28, 1.00)">
												<strong class="caption-title">I want to buy a home</strong>
											</div>
										</label>
									</div>
								</div>
								<div class="images-answer-col">
									<div class="images-answer-block">
										<label class="image-answer-label">
											<input type="radio" name="image_33" value="I want to refinance"
												class="image-answer-checkbox" required="">
											<span class="selection-check"></span>
											<div class="image-holder" style="border-radius: 12px">
												<div class="image-wrap">
													<img src="https://images.lp-images1.com/images1/1/17344//pics/image_1691618222.png"
														alt="">
												</div>
											</div>
											<div class="image-answer-caption" style="color: rgba(0, 16, 28, 1.00)">
												<strong class="caption-title">I want to refinance</strong>
											</div>
										</label>
									</div>
								</div>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What is your branch of service?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Army" class="form-field" required="" type="radio" name="menu_2" value="Army">
								<label for="Army" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Army</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Marine_Corps" class="form-field" required="" type="radio" name="menu_2"
									value="Marine Corps">
								<label for="Marine_Corps" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Marine Corps</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Navy" class="form-field" required="" type="radio" name="menu_2" value="Navy">
								<label for="Navy" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Navy</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="AirForce" class="form-field" required="" type="radio" name="menu_2"
									value="Air Force">
								<label for="AirForce" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Air Force</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Coast_Guard" class="form-field" required="" type="radio" name="menu_2"
									value="Coast Guard">
								<label for="Coast_Guard" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Coast Guard</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Space_Force" class="form-field" required="" type="radio" name="menu_2"
									value="Space Force">
								<label for="Space_Force" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Space Force</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Militery_Spouse" class="form-field" required="" type="radio" name="menu_2"
									value="Militery Spouse">
								<label for="Militery_Spouse" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Militery Spouse</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Other" class="form-field" required="" type="radio" name="menu_2"
									value="Other VA Eligibility">
								<label for="Other" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Other VA Eligibility</span>
								</label>
							</div>
						</div>
						<!-- <div class="text-center">
									<a href="#" class="btn ah-cta-btn btn-next"
										style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;">
										Continue </a>
								</div> -->
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">

						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Why do you want to refinance?</strong>
							</h1>
							<div class="question-description-text ">
								<p style="color: rgb(27, 117, 187);">(select all that apply)</p>
							</div>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Lower_my_rate_payment" class="form-field" required="" type="checkbox"
									name="menu_2_1" value="Lower my rate / payment">
								<label for="Lower_my_rate_payment" class="checkbox-button">
									<span class="fake-input"></span>
									<span>Lower my rate / payment</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Change_my_loan_term" class="form-field" required="" type="checkbox"
									name="menu_2_1" value="Change my loan term">
								<label for="Change_my_loan_term" class="checkbox-button">
									<span class="fake-input"></span>
									<span>Change my loan term</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Take_cash_out_of_home" class="form-field" required="" type="checkbox"
									name="menu_2_1" value="Take cash out of home">
								<label for="Take_cash_out_of_home" class="checkbox-button">
									<span class="fake-input"></span>
									<span>Take cash out of home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Pay_off_debts" class="form-field" required="" type="checkbox" name="menu_2_1"
									value="Pay off debts">
								<label for="Pay_off_debts" class="checkbox-button">
									<span class="fake-input"></span>
									<span>Pay off debts</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Other1" class="form-field" required="" type="checkbox" name="menu_2_1"
									value="Other">
								<label for="Other1" class="checkbox-button">
									<span class="fake-input"></span>
									<span>Other</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Regular Military, Reserves, or National Guard?</strong>
							</h1>
							<div class="question-description-text ">
								<p style="color: rgb(27, 117, 187);">If multiple, select the option that best
									describes the majority of your military service.</p>
							</div>
						</div>
						<div class="checkbox-list-holder mb-4 flex-column align-items-center">
							<div class="form-group question__fields text-center">
								<input id="RegularMilitary" class="form-field" required="" type="radio" name="menu_3"
									value="Regular Military">
								<label for="RegularMilitary" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Regular Military</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Reserves" class="form-field" required="" type="radio" name="menu_3"
									value="Reserves">
								<label for="Reserves" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Reserves</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="NationalGuard" class="form-field" required="" type="radio" name="menu_3"
									value="National Guard">
								<label for="NationalGuard" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>National Guard</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What's your price range?</strong>
							</h1>
						</div>
						<div class="question-description-text text-center mb-4">
							<p style="color: rgb(27, 117, 187);">(it's ok to estimate)</p>
						</div>

						<div class="cash_wrapper wrapper mb-4">
							<div class="cash_wrapper_number mb-5 text-center">0 to <span
									class="cash_wrapper_value mb-5 text-center">0</span></div>
							<div class="cash_range mb-4">
								<input type="range" min="0" max="1000000" value="0" id="cash_range" />
							</div>
							<div class="d-flex justify-content-between number-slider">
								<span>0</span>
								<span>$1M+</span>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What Type of Property are you buying?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="SingleFamilyHome" class="form-field" required="" type="radio" name="menu_5"
									value="Single Family Home">
								<label for="SingleFamilyHome" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Single Family Home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="TownHome" class="form-field" required="" type="radio" name="menu_5"
									value="Town Home">
								<label for="TownHome" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Town Home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Mobile/Manufactured" class="form-field" required="" type="radio"
									name="menu_5" value="Mobile/Manufactured">
								<label for="Mobile/Manufactured" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Mobile/Manufactured</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Condominium" class="form-field" required="" type="radio" name="menu_5"
									value="Condominium">
								<label for="Condominium" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Condominium</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Multi-Family" class="form-field" required="" type="radio" name="menu_5"
									value="Multi-Family">
								<label for="Multi-Family" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Multi-Family</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="NewConstruction" class="form-field" required="" type="radio" name="menu_5"
									value="New Construction">
								<label for="NewConstruction" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>New Construction</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>How Are You Using This Home? </strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4 flex-column align-items-center">
							<div class="form-group question__fields text-center">
								<input id="PrimaryHome" class="form-field" required="" type="radio" name="menu_6"
									value="Primary Home">
								<label for="PrimaryHome" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Primary Home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="SecondaryVacationHome" class="form-field" required="" type="radio"
									name="menu_6" value="Secondary / Vacation Home">
								<label for="SecondaryVacationHome" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Secondary / Vacation Home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="InvestmentProperty" class="form-field" required="" type="radio" name="menu_6"
									value="Investment Property">
								<label for="InvestmentProperty" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Investment Property</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Other2" class="form-field" required="" type="radio" name="menu_6"
									value="Other">
								<label for="Other2" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Other</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>When are you planning to make your Home Purchase?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Needhurry" class="form-field" required="" type="radio" name="menu_7"
									value="Need to hurry: Already signed an offer">
								<label for="Needhurry" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Need to hurry: Already signed an offer</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Within30Days" class="form-field" required="" type="radio" name="menu_7"
									value="Within 30 Days">
								<label for="Within30Days" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Within 30 Days</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="3-6Months" class="form-field" required="" type="radio" name="menu_7"
									value="3-6 Months">
								<label for="3-6Months" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>3-6 Months</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="ASAP" class="form-field" required="" type="radio" name="menu_7" value="ASAP">
								<label for="ASAP" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>ASAP: Found a House and made an offer</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="2-3Months" class="form-field" required="" type="radio" name="menu_7"
									value="2-3 Months">
								<label for="2-3Months" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>2-3 Months</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="6Months" class="form-field" required="" type="radio" name="menu_7"
									value="6 Months">
								<label for="6Months" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>6 Months</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Do you currently own a home?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4 flex-column align-items-center">
							<div class="form-group question__fields text-center">
								<input id="CurrentlyOwnHome" class="form-field" required="" type="radio" name="menu_8"
									value="Currently Own Home">
								<label for="CurrentlyOwnHome" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Currently Own Home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="CurrentlyRentingHome" class="form-field" required="" type="radio"
									name="menu_8" value="Currently Renting Home">
								<label for="CurrentlyRentingHome" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Currently Renting Home</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="OtherLivingArrangments" class="form-field" required="" type="radio"
									name="menu_8" value="Other Living Arrangments">
								<label for="OtherLivingArrangments" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Other Living Arrangments</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What is your current credit score?</strong>
							</h1>
							<div class="question-description-text ">
								<p style="color: rgb(27, 117, 187);">(it's ok to estimate)</p>
							</div>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Excellent720+" class="form-field" required="" type="radio" name="menu_9"
									value="Excellent (720+)">
								<label for="Excellent720+" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Excellent (720+)</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Good" class="form-field" required="" type="radio" name="menu_9"
									value="Good (680-719)">
								<label for="Good" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Good (680-719)</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Fair" class="form-field" required="" type="radio" name="menu_9"
									value="Fair (640-679)">
								<label for="Fair" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Fair (640-679)</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="BelowAverage" class="form-field" required="" type="radio" name="menu_9"
									value="Below Average (620-639)">
								<label for="BelowAverage" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Below Average (620-639)</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Poor" class="form-field" required="" type="radio" name="menu_9"
									value="Poor (Below 620)">
								<label for="Poor" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Poor (Below 620)</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="I_dont_Know" class="form-field" required="" type="radio" name="menu_9"
									value="I don't Know">
								<label for="I_dont_Know" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>I don't Know</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What is your current marital status?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Married" class="form-field" required="" type="radio" name="menu_10"
									value="Married">
								<label for="Married" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Married</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Unmarried" class="form-field" required="" type="radio" name="menu_10"
									value="Unmarried">
								<label for="Unmarried" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Unmarried</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="LegallySeparated" class="form-field" required="" type="radio" name="menu_10"
									value="Legally Separated">
								<label for="LegallySeparated" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Legally Separated</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Widowed" class="form-field" required="" type="radio" name="menu_10"
									value="Widowed">
								<label for="Widowed" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Widowed</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Other3" class="form-field" required="" type="radio" name="menu_10"
									value="Other">
								<label for="Other3" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Other</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="rather_not_say" class="form-field" required="" type="radio" name="menu_10"
									value="I'd rather not say">
								<label for="rather_not_say" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>I'd rather not say</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What's your household gross (before taxes) annual income?</strong>
							</h1>
							<div class="question-description-text ">
								<p style="color: rgb(27, 117, 187);">If multiple, select the option that best
									describes the majority of your military service.</p>
							</div>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Greaterthan$200,000" class="form-field" required="" type="radio"
									name="menu_11" value="Greater than $200,000">
								<label for="Greaterthan$200,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Greater than $200,000</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="$150,000_$200,000" class="form-field" required="" type="radio" name="menu_11"
									value="$150,000 - $200,000">
								<label for="$150,000_$200,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>$150,000 - $200,000</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="$100,000-$150,000" class="form-field" required="" type="radio" name="menu_11"
									value="$100,000 - $150,000">
								<label for="$100,000-$150,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>$100,000 - $150,000</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="$75,000-$100,000" class="form-field" required="" type="radio" name="menu_11"
									value="$75,000 - $100,000">
								<label for="$75,000-$100,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>$75,000 - $100,000</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="$50,000-$75,000" class="form-field" required="" type="radio" name="menu_11"
									value="$50,000 - $75,000">
								<label for="$50,000-$75,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>$50,000 - $75,000</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="$30,000-$50,000" class="form-field" required="" type="radio" name="menu_11"
									value="$30,000 - $50,000">
								<label for="$30,000-$50,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>$30,000 - $50,000</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Lessthan$30,000" class="form-field" required="" type="radio" name="menu_11"
									value="Less than $30,000">
								<label for="Lessthan$30,000" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Less than $30,000</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Have You Declared Bankruptcy in the past 2 years? </strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4 flex-column align-items-center">
							<div class="form-group question__fields text-center">
								<input id="Yes" class="form-field" required="" type="radio" name="menu_8" value="Yes">
								<label for="Yes" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Yes</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="No" class="form-field" required="" type="radio" name="menu_8" value="No">
								<label for="No" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>No</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Do you have an active account with any of these institutions?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Chase" class="form-field" required="" type="radio" name="menu_15"
									value="Chase">
								<label for="Chase" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Chase</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="BankofAmerica" class="form-field" required="" type="radio" name="menu_15"
									value="Bank of America">
								<label for="BankofAmerica" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Bank of America</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="WellsFargo" class="form-field" required="" type="radio" name="menu_15"
									value="Wells Fargo">
								<label for="WellsFargo" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Wells Fargo</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="CitibankNA" class="form-field" required="" type="radio" name="menu_15"
									value="Citibank, NA">
								<label for="CitibankNA" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Citibank, NA</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="USBank" class="form-field" required="" type="radio" name="menu_15"
									value="US Bank">
								<label for="USBank" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>US Bank</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="PNCBank" class="form-field" required="" type="radio" name="menu_15"
									value="PNC Bank">
								<label for="PNCBank" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>PNC Bank</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="NavyFederalCreditUnion" class="form-field" required="" type="radio"
									name="menu_15" value="Navy Federal Credit Union">
								<label for="NavyFederalCreditUnion" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Navy Federal Credit Union</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="NoneoftheAbove" class="form-field" required="" type="radio" name="menu_15"
									value="None of the Above – Allow Manual Entry of Bank Name">
								<label for="NoneoftheAbove" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>None of the Above – Allow Manual Entry of Bank Name</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What's your employment status?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4">
							<div class="form-group question__fields text-center">
								<input id="Employed" class="form-field" required="" type="radio" name="menu_16"
									value="Employed">
								<label for="Employed" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Employed</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="SelfEmployed" class="form-field" required="" type="radio" name="menu_16"
									value="Self Employed / 1099 Independent Contractor">
								<label for="SelfEmployed" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Self Employed / 1099 Independent Contractor</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Retired" class="form-field" required="" type="radio" name="menu_16"
									value="Retired">
								<label for="Retired" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Retired</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="Military" class="form-field" required="" type="radio" name="menu_16"
									value="Military">
								<label for="Military" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Military</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="NotEmployed" class="form-field" required="" type="radio" name="menu_16"
									value="Not Employed">
								<label for="NotEmployed" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Not Employed</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Have you filed for bankruptcy, or had a short sale or foreclosure in the
									last 3 years?</strong>
							</h1>
						</div>
						<div class="checkbox-list-holder mb-4 flex-column align-items-center">
							<div class="form-group question__fields text-center">
								<input id="page_Yes" class="form-field" required="" type="radio" name="menu_17"
									value="Yes">
								<label for="page_Yes" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>Yes</span>
								</label>
							</div>
							<div class="form-group question__fields text-center">
								<input id="page_No" class="form-field" required="" type="radio" name="menu_17"
									value="No">
								<label for="page_No" class="checkbox-button">
									<span class="fake-input border-0"></span>
									<span>No</span>
								</label>
							</div>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>Where is your home located?</strong>
							</h1>
						</div>
						<div class="form-group-input mb-5">
							<input type="text" id="zipcode_32" name="zipcode_32" class="form-control" autocomplete="off"
								data-auto-focus="true" required="">
							<label for="zipcode_32" class="input-label">CITY OR ZIP CODE</label>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What is Your Full Name?</strong>
							</h1>
						</div>
						<div class="form-group-input mb-5">
							<input type="text" id="name" name="fullname" class="form-control" autocomplete="off"
								data-auto-focus="true" required="">
							<label for="name" class="input-label">Full Name</label>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What's your email address?</strong>
							</h1>
						</div>
						<div class="form-group-input mb-5">
							<input type="email" id="email" name="email" class="form-control" autocomplete="off"
								data-auto-focus="true" required="">
							<label for="email" class="input-label">Email Address</label>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<fieldset class="funnel-content-section">
						<div class="question__title">
							<h1 class="question-heading-text text-center text-white mb-4">
								<strong>What is your Phone Number</strong>
							</h1>
						</div>
						<div class="form-group-input mb-5">
							<input type="tel" id="phone_number" name="phone_number" class="form-control"
								autocomplete="off" data-auto-focus="true" placeholder="(xxx) xxx-xxxx" maxlength="14"
								required="" style="text-align: center;">
							<label for="phone_number" class="input-label">Phone number</label>
						</div>
						<button type="button" class="btn ah-cta-btn previous"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Back</button>
						<button type="button" class="btn ah-cta-btn next"
							style="font-size: 20px; font-weight: 800 !important; font-style: normal !important; color: rgb(255, 255, 255) !important; border-color: rgb(255, 130, 1) !important; border-width: 1px !important; background: rgb(255, 130, 1) !important; border-radius: 36px !important; box-shadow: rgba(0, 0, 0, 0.2) 0px 16px 13px -10px !important;margin: 0 5px;">Continue</button>
					</fieldset>
					<br>
					<br>
					<br>
					<div style="line-height: 1;"><span style="font-family: Montserrat; font-size: 18px;"><span
								style="color: rgb(255, 255, 255);"><strong>VA Loan
									Basics</strong></span></span><span
							style="color: rgb(255, 255, 255);"><br></span><span
							style="font-family: Montserrat; font-size: 18px;"><span
								style="color: rgb(255, 255, 255);"><br>The VA Loan, backed by the U.S. Department of
								Veterans Affairs, is a special mortgage program designed for military service
								members, veterans, and eligible surviving spouses. Key highlights of this loan
								include: <br></span></span></div> <br>
					<ul style="margin-left: 20px; list-style-type: square;">
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">No down payment
								requirement</span><br><br></li>
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">Competitive interest rates often
								lower than traditional mortgages</span><br><br></li>
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">No private mortgage insurance
								(PMI) necessary</span><br><br></li>
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">Simplified qualification process
								for veterans and active-duty military.<br></span></li>
					</ul>
					<div style="line-height: 1;"><span style="font-family: Montserrat; font-size: 18px;"><span
								style="color: rgb(255, 255, 255);"><strong>Key Benefits of VA
									Loans</strong></span></span><span
							style="color: rgb(255, 255, 255);"><br><br></span><span
							style="font-family: Montserrat; font-size: 18px;"><span
								style="color: rgb(255, 255, 255);">For those eligible, the VA Loan offers unparalleled
								benefits not found with most traditional loans. These advantages include:
								<br></span></span></div> <br>
					<ul style="margin-left: 20px; list-style-type: square;">
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">Zero Down Payment: Enabling veterans
								to purchase without the immediate financial burden</span><br><br></li>
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">No PMI: This reduces monthly payments,
								saving homeowners significant money over the loan's lifetime</span><br><br></li>
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">Flexible Qualification Criteria:
								Understanding the unique circumstances of military life</span><br><br></li>
						<li style="line-height: 1; color: rgb(255, 255, 255);"><span
								style="font-family: Montserrat; font-size: 18px;">Limits on Closing Costs: The seller
								can pay closing costs, and the VA limits certain fees charged to the buyer<br></span>
						</li>
					</ul>
				</form>
			</section>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<!-- <script>
		document.addEventListener('DOMContentLoaded', function () {
			var rangeInput = document.getElementById('myRange');
			var rangeValueDisplay = document.getElementById('rangeValue');

			// Update the value display when the range input changes
			rangeInput.addEventListener('input', function () {
				rangeValueDisplay.textContent = rangeInput.value;
			});

			// Function to increase the range value
			function increaseValue() {
				if (parseInt(rangeInput.value) < parseInt(rangeInput.max)) {
					rangeInput.value = parseInt(rangeInput.value) + 1;
					rangeValueDisplay.textContent = rangeInput.value;
				}
			}

			// Function to decrease the range value
			function decreaseValue() {
				if (parseInt(rangeInput.value) > parseInt(rangeInput.min)) {
					rangeInput.value = parseInt(rangeInput.value) - 1;
					rangeValueDisplay.textContent = rangeInput.value;
				}
			}

			// Attach event listeners to buttons to increase and decrease the value
			document.getElementById('increaseButton').addEventListener('click', increaseValue);
			document.getElementById('decreaseButton').addEventListener('click', decreaseValue);
		});
	</script> -->

	<script>

		document.getElementById('phone_number').addEventListener('input', function (e) {
			let input = e.target.value.replace(/\D/g, '').substring(0, 10);
			let areaCode = input.substring(0, 3);
			let middle = input.substring(3, 6);
			let last = input.substring(6, 10);

			if (input.length > 6) {
				e.target.value = `(${areaCode}) ${middle}-${last}`;
			} else if (input.length > 3) {
				e.target.value = `(${areaCode}) ${middle}`;
			} else if (input.length > 0) {
				e.target.value = `(${areaCode}`;
			} else {
				e.target.value = '';
			}
		});

		document.addEventListener('DOMContentLoaded', function () {
			const nextButtons = document.querySelectorAll('.next');
			const prevButtons = document.querySelectorAll(".previous");

			// Add event listener for Previous buttons
			prevButtons.forEach(button => {
				button.addEventListener("click", function () {
					const currentFieldset = this.parentElement;
					const prevFieldset = currentFieldset.previousElementSibling;

					currentFieldset.style.display = "none";
					prevFieldset.style.display = "block";
				});
			});

			nextButtons.forEach(button => {
				button.addEventListener('click', function (e) {

					const fieldset = button.parentNode;
					const radioInputs = fieldset.querySelectorAll('input[type="radio"]');
					const numberInputs = fieldset.querySelectorAll('input[type="number"]');
					const textInputs = fieldset.querySelectorAll('input[type="text"]');
					let isValid = true;

					// Check if any text input field is empty
					console.log();
					if (fieldset.children[1].children[0].tagName === 'INPUT') {

						if (fieldset.children[1].children[0].value.trim() === "") {
							alert("fill that field")
						} else {
							const nextFieldset = fieldset.nextElementSibling;
							if (nextFieldset) {
								fieldset.style.display = 'none';
								nextFieldset.style.display = 'block';
							}
						}
					} else {
						let isChecked = false;

						if (radioInputs.length === 0) {
							isChecked = true;
						}
						// Check if at least one radio input is checked
						radioInputs.forEach(input => {
							if (input.checked) {
								isChecked = true;
							}
						});

						// If at least one radio input is checked, proceed to the next fieldset
						// Otherwise, display an error message or prevent form submission
						if (isChecked) {
							// Proceed to the next fieldset
							const nextFieldset = fieldset.nextElementSibling;
							if (nextFieldset) {
								fieldset.style.display = 'none';
								nextFieldset.style.display = 'block';
							}
						} else {
							// Display an error message or prevent form submission
							alert('Please select an option');
						}
					}
				});
			});
		});

	</script>
	<script>
		const sliderEl = document.querySelector("#cash_range")
		const sliderValue = document.querySelector(".cash_wrapper_value")

		sliderEl.addEventListener("input", (event) => {
			const tempSliderValue = event.target.value;

			const formattedValue = Number(tempSliderValue).toLocaleString();
			sliderValue.textContent = formattedValue;

			const progress = (tempSliderValue / sliderEl.max) * 100;

			sliderEl.style.background = `linear-gradient(to right, #fff ${progress}%, #00101c ${progress}%)`;
		})
	</script>
</body>

</html>