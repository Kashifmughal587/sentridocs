<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lead Generation Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.2/css/intlTelInput.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/demo.css">
</head>

<body>
    <main>
        <article class="main">
            <section class="multi_step_form">
                <form id="msform" action="process_form.php" method="POST">
                    <header class="intro">
                        <img src="assets/images/logoipsum-325.svg" alt="SITE LOGO">
                    </header>
                    <!-- fieldsets -->
                    <fieldset><!-- Page 1 -->
                        <h2>CALCULATE A LOWER MONTHLY PAYMENT</h2>
                        <h3>Refinance to a lower rate and monthly payment to save thousands on your mortgage</h3>
                        <p>Select an option below to find out what you qualify for now!</p>
                        <div class="d-flex ah-card-img-holder" style="margin-bottom: 50px;">
                            <label for="singleFamily" class="ah-card-img">
                                <input id="singleFamily" type="radio" name="property_type" value="singleFamily">
                                <div class="ah-card-inner">
                                    <div class="ah-img-holder">
                                        <img src="assets/images/img_1.png" class="card-img-top" alt="Image 1">
                                    </div>
                                    <h5 class="ah-card-title">Single Family Home</h5>
                                </div>
                            </label>
                            <label for="Condominium" class="ah-card-img">
                                <input id="Condominium" type="radio" name="property_type" value="Condominium">
                                <div class="ah-card-inner">
                                    <div class="ah-img-holder">
                                        <img src="assets/images/img_2.png" class="card-img-top" alt="Image 1">
                                    </div>
                                    <h5 class="ah-card-title">Condominium</h5>
                                </div>
                            </label>
                            <label for="Townhome" class="ah-card-img">
                                <input id="Townhome" type="radio" name="property_type" value="Townhome">
                                <div class="ah-card-inner">
                                    <div class="ah-img-holder">
                                        <img src="assets/images/img_3.png" class="card-img-top" alt="Image 1">
                                    </div>
                                    <h5 class="ah-card-title">Townhome</h5>
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 2 -->
                        <h2>What type of home loan are you refinancing?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="conventionalLoan">
                                <input id="conventionalLoan" type="radio" name="loan_type" class="form-check-input" value="conventional">
                                <div class="form-check-label-inner">
                                    Conventional Loan
                                </div>
                            </label>
                            <label class="form-check-label" for="VALoan">
                                <input id="VALoan" type="radio" name="loan_type" class="form-check-input" value="va">
                                <div class="form-check-label-inner">
                                    VA Loan
                                </div>
                            </label>
                            <label class="form-check-label" for="USDALoan">
                                <input id="USDALoan" type="radio" name="loan_type" class="form-check-input" value="usda">
                                <div class="form-check-label-inner">
                                    USDA Loan
                                </div>
                            </label>
                            <label class="form-check-label" for="FHALoan">
                                <input id="FHALoan" type="radio" name="loan_type" class="form-check-input" value="fha">
                                <div class="form-check-label-inner">
                                    FHA Loan
                                </div>
                            </label>
                            <label class="form-check-label" for="loan_typeDontKnow">
                                <input id="loan_typeDontKnow" type="radio" name="loan_type" class="form-check-input" value="dont_know">
                                <div class="form-check-label-inner">
                                    I don't know
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 3 -->
                        <h2>What's your home loan refinancing goal?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="TakeCash">
                                <input id="TakeCash" type="radio" name="mortgage_goal" class="form-check-input" value="take_cash">
                                <div class="form-check-label-inner">
                                    Take Cash Out of My Home
                                </div>
                            </label>
                        </div>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="PayOffDebts">
                                <input id="PayOffDebts" type="radio" name="mortgage_goal" class="form-check-input" value="pay_off_debts">
                                <div class="form-check-label-inner">
                                    Pay Off Debts
                                </div>
                            </label>
                        </div>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="MonthlyPayments">
                                <input id="MonthlyPayments" type="radio" name="mortgage_goal" class="form-check-input" value="lower_monthly_payments">
                                <div class="form-check-label-inner">
                                    Lower My Monthly Payments
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 4 -->
                        <h3>What's the value of your home?</h3>
                        <h6>(an estimate is fine)</h6>
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <div class="w-50 position-relative">
                                <input type="number" name="value_property" class="form-control" placeholder="Estimated Home Value" id="estimatedHomeValue">
                                <span class="clear-input" id="clearEstimatedHomeValue">&times;</span>
                            </div>
                        </div>

                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 5 -->
                        <h3>What's the remaining balance of your current loan?</h3>
                        <h6>(an estimate is fine)</h6>
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <div class="w-50 position-relative">
                                <input type="number" name="loan_balance" class="form-control" placeholder="Estimated Loan Balance" id="estimatedLoanValue">
                                <span class="clear-input" id="clearEstimatedLoanValue">&times;</span>
                            </div>
                        </div>

                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 6 -->
                        <h3>What's your current mortgage interest rate?</h3>
                        <div class="form-group">
                            <select class="product_select form-control" name="current_interest_rate" id="current_interest_rate">
                                <option data-display="1. Choose A Question">SELECT YOUR CURRENT RATE</option>
                                <option value="1">UNDER 3%</option>
                                <option value="3.25">3.25 %</option>
                                <option value="3.50">3.50 %</option>
                                <option value="3.75">3.75 %</option>
                                <option value="4.00">4.00 %</option>
                                <option value="4.25">4.25 %</option>
                                <option value="4.50">4.50 %</option>
                                <option value="4.75">4.75 %</option>
                                <option value="5.00">5.00 %</option>
                                <option value="5.25">5.25 %</option>
                                <option value="5.50">5.50 %</option>
                                <option value="5.75">5.75 %</option>
                                <option value="6.00">6.00 %</option>
                                <option value="6.25">6.25 %</option>
                                <option value="6.50">6.50 %</option>
                                <option value="6.75">6.75 %</option>
                                <option value="7.00">7.00 %</option>
                                <option value="7.25">7.25 %</option>
                                <option value="7.50">7.50 %</option>
                                <option value="7.75">7.75 %</option>
                                <option value="8.00">8.00 %</option>
                                <option value="8.25">8.25 %</option>
                                <option value="8.50">8.50 %</option>
                                <option value="8.75">8.75 %</option>
                                <option value="9.00">9.00 %</option>
                                <option value="9.25">9.25 %</option>
                                <option value="9.50">9.50 %</option>
                                <option value="9.75">9.75 %</option>
                                <option value="10.00">10.00 %</option>
                            </select>
                        </div>

                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 7 -->
                        <h2>What kind of home do you currently own?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="SingleFamilyproperty_ownership">
                                <input id="SingleFamilyproperty_ownership" type="radio" name="property_ownership" class="form-check-input" value="single_family">
                                <div class="form-check-label-inner">
                                    Single Family
                                </div>
                            </label>
                            <label class="form-check-label" for="Condominiumproperty_ownership">
                                <input id="Condominiumproperty_ownership" type="radio" name="property_ownership" class="form-check-input" value="condominium">
                                <div class="form-check-label-inner">
                                    Condominium
                                </div>
                            </label>
                            <label class="form-check-label" for="TownHomeproperty_ownership">
                                <input id="TownHomeproperty_ownership" type="radio" name="property_ownership" class="form-check-input" value="town_home">
                                <div class="form-check-label-inner">
                                    Town Home
                                </div>
                            </label>
                            <label class="form-check-label" for="MultiFamilyproperty_ownership">
                                <input id="MultiFamilyproperty_ownership" type="radio" name="property_ownership" class="form-check-input" value="multi_family">
                                <div class="form-check-label-inner">
                                    Multi-Family
                                </div>
                            </label>
                            <label class="form-check-label" for="Manufacturedproperty_ownership">
                                <input id="Manufacturedproperty_ownership" type="radio" name="property_ownership" class="form-check-input" value="manufactured">
                                <div class="form-check-label-inner">
                                    Mobile / Manufactured
                                </div>
                            </label>
                        </div>

                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 8 -->
                        <h2>How are you using this home?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="PrimaryHome">
                                <input id="PrimaryHome" type="radio" name="property_use" class="form-check-input" value="primary_home">
                                <div class="form-check-label-inner">
                                    Primary Home
                                </div>
                            </label>
                            <label class="form-check-label" for="VacationHome">
                                <input id="VacationHome" type="radio" name="property_use" class="form-check-input" value="vacation_home">
                                <div class="form-check-label-inner">
                                    Secondary / Vacation Home
                                </div>
                            </label>
                            <label class="form-check-label" for="InvestmentProperty">
                                <input id="InvestmentProperty" type="radio" name="property_use" class="form-check-input" value="investment_property">
                                <div class="form-check-label-inner">
                                    Investment Property
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 9 -->
                        <h2>Have you (or your spouse) ever served in the US military?</h2>
                        <h6>Active-duty military and Veterans may qualify for a VA Loan with $0 down and no PMI.</h6>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="MilitaryService">
                                <input id="MilitaryService" type="radio" name="military_service" class="form-check-input" value="no_military_service">
                                <div class="form-check-label-inner">
                                    No Military Service
                                </div>
                            </label>
                        </div>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="iServedpage9">
                                <input id="iServedpage9" type="radio" name="military_service" class="form-check-input" value="served_in_military">
                                <div class="form-check-label-inner">
                                    Yes, I (or my spouse) served
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 10 -->
                        <h2>Do you have an active account with any of these institutions?</h2>
                        <h6>(Select all that apply)</h6>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="Chase">
                                <input id="Chase" type="checkbox" name="bank_customer_1" class="form-check-input" value="chase">
                                <div class="form-check-label-inner">
                                    Chase
                                </div>
                            </label>
                            <label class="form-check-label" for="BankofAmerica">
                                <input id="BankofAmerica" type="checkbox" name="bank_customer_2" class="form-check-input" value="bank_of_america">
                                <div class="form-check-label-inner">
                                    Bank of America
                                </div>
                            </label>
                            <label class="form-check-label" for="WellsFargo">
                                <input id="WellsFargo" type="checkbox" name="bank_customer_3" class="form-check-input" value="wells_fargo">
                                <div class="form-check-label-inner">
                                    Wells Fargo
                                </div>
                            </label>
                            <label class="form-check-label" for="Citibank_NA">
                                <input id="Citibank_NA" type="checkbox" name="bank_customer_4" class="form-check-input" value="citibank_na">
                                <div class="form-check-label-inner">
                                    Citibank, N.A.
                                </div>
                            </label>
                            <label class="form-check-label" for="USBankpage10">
                                <input id="USBankpage10" type="checkbox" name="bank_customer_5" class="form-check-input" value="us_bank">
                                <div class="form-check-label-inner">
                                    US Bank
                                </div>
                            </label>
                            <label class="form-check-label" for="PNCBank">
                                <input id="PNCBank" type="checkbox" name="bank_customer_6" class="form-check-input" value="pnc_bank">
                                <div class="form-check-label-inner">
                                    PNC Bank
                                </div>
                            </label>
                            <label class="form-check-label" for="NavyFederalCreditUnion">
                                <input id="NavyFederalCreditUnion" type="checkbox" name="bank_customer_7" class="form-check-input" value="navy_federal_credit_union">
                                <div class="form-check-label-inner">
                                    Navy Federal Credit Union
                                </div>
                            </label>
                            <label class="form-check-label" for="nonePage10">
                                <input id="nonePage10" type="checkbox" name="bank_customer_8" class="form-check-input" value="none_of_the_above">
                                <div class="form-check-label-inner">
                                    None of the Above
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button" style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 11 -->
                        <h2>What's your employment status?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="EmployedPage11">
                                <input id="EmployedPage11" type="radio" name="employment_status" class="form-check-input" value="employed">
                                <div class="form-check-label-inner">
                                    Employed
                                </div>
                            </label>
                            <label class="form-check-label" for="IndependentContractorPage11">
                                <input id="IndependentContractorPage11" type="radio" name="employment_status" class="form-check-input" value="self_employed">
                                <div class="form-check-label-inner">
                                    Self-Employed / 1099 Independent Contractor
                                </div>
                            </label>
                            <label class="form-check-label" for="RetiredPage11">
                                <input id="RetiredPage11" type="radio" name="employment_status" class="form-check-input" value="retired">
                                <div class="form-check-label-inner">
                                    Retired
                                </div>
                            </label>
                            <label class="form-check-label" for="MilitaryPage11">
                                <input id="MilitaryPage11" type="radio" name="employment_status" class="form-check-input" value="military">
                                <div class="form-check-label-inner">
                                    Military
                                </div>
                            </label>
                            <label class="form-check-label" for="NotEmployedPage11">
                                <input id="NotEmployedPage11" type="radio" name="employment_status" class="form-check-input" value="not_employed">
                                <div class="form-check-label-inner">
                                    Not Employed
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button" style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 12 -->
                        <h2>What's your household gross (before taxes) annual income?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="incomePage12_0">
                                <input id="incomePage12_0" type="radio" name="household_income" class="form-check-input" value="greater_than_200000">
                                <div class="form-check-label-inner">
                                    Greater than $200,000
                                </div>
                            </label>
                            <label class="form-check-label" for="incomePage12_1">
                                <input id="incomePage12_1" type="radio" name="household_income" class="form-check-input" value="150000_200000">
                                <div class="form-check-label-inner">
                                    $150,000 - $200,000
                                </div>
                            </label>
                            <label class="form-check-label" for="incomePage12_2">
                                <input id="incomePage12_2" type="radio" name="household_income" class="form-check-input" value="100000_150000">
                                <div class="form-check-label-inner">
                                    $100,000 - $150,000
                                </div>
                            </label>
                            <label class="form-check-label" for="incomePage12_3">
                                <input id="incomePage12_3" type="radio" name="household_income" class="form-check-input" value="75000_100000">
                                <div class="form-check-label-inner">
                                    $75,000 - $100,000
                                </div>
                            </label>
                            <label class="form-check-label" for="incomePage12_4">
                                <input id="incomePage12_4" type="radio" name="household_income" class="form-check-input" value="50000_75000">
                                <div class="form-check-label-inner">
                                    $50,000 - $75,000
                                </div>
                            </label>
                            <label class="form-check-label" for="incomePage12_5">
                                <input id="incomePage12_5" type="radio" name="household_income" class="form-check-input" value="30000_50000">
                                <div class="form-check-label-inner">
                                    $30,000 - $50,000
                                </div>
                            </label>
                            <label class="form-check-label" for="incomePage12_6">
                                <input id="incomePage12_6" type="radio" name="income_range" class="form-check-input" value="less_than_30000">
                                <div class="form-check-label-inner">
                                    Less than $30,000
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button" style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 13 -->
                        <h2>Have you filed for bankruptcy, or had a short sale or foreclosure in the last 3 years?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="bankruptcyYesPage13">
                                <input id="bankruptcyYesPage13" type="radio" name="bankruptcy_foreclosure" class="form-check-input" value="yes">
                                <div class="form-check-label-inner">
                                    Yes
                                </div>
                            </label>
                            <label class="form-check-label" for="bankruptcyNoPage13">
                                <input id="bankruptcyNoPage13" type="radio" name="bankruptcy_foreclosure" class="form-check-input" value="no">
                                <div class="form-check-label-inner">
                                    No
                                </div>
                            </label>
                        </div>
                        <button type="button" class="action-button previous previous_button" style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 14 -->
                        <h2>Would you like to take out additional cash</h2>
                        <h6>The average Homeowner Could Cash Out</h6>
                        <p>$0 to <span id="rangeValue">0</span></p>
                        <div class="">
                            <input type="range" id="cash_out_amount" name="cash_out_amount" min="0" max="300000" value="0">

                            <div class="d-flex justify-content-between">
                                <span>$0</span>
                                <span>$300K+</span>
                            </div>
                            <button type="hidden" style="display: none;" id="increaseButton">Increase Value</button>
                            <button type="hidden" style="display: none;" id="decreaseButton">Decrease Value</button>
                        </div>

                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 15 -->
                        <h2>What’s your Current Credit Score?</h2>
                        <div class="check-list-holder">
                            <label class="form-check-label" for="ExcellentPage13">
                                <input id="ExcellentPage13" type="radio" name="credit_score" class="form-check-input" value="excellent">
                                <div class="form-check-label-inner">
                                    Excellent (720+)
                                </div>
                            </label>
                            <label class="form-check-label" for="GoodPage13">
                                <input id="GoodPage13" type="radio" name="credit_score" class="form-check-input" value="good">
                                <div class="form-check-label-inner">
                                    Good (680-719)
                                </div>
                            </label>
                            <label class="form-check-label" for="FairPage13">
                                <input id="FairPage13" type="radio" name="credit_score" class="form-check-input" value="fair">
                                <div class="form-check-label-inner">
                                    Fair (660-679)
                                </div>
                            </label>
                            <label class="form-check-label" for="BelowAveragePage13">
                                <input id="BelowAveragePage13" type="radio" name="credit_score" class="form-check-input" value="below_average">
                                <div class="form-check-label-inner">
                                    Below Average (620-659)
                                </div>
                            </label>
                            <label class="form-check-label" for="poorPage13">
                                <input id="poorPage13" type="radio" name="credit_score" class="form-check-input" value="poor">
                                <div class="form-check-label-inner">
                                    Poor (580-619)
                                </div>
                            </label>
                            <label class="form-check-label" for="BadPage13">
                                <input id="BadPage13" type="radio" name="credit_score" class="form-check-input" value="bad">
                                <div class="form-check-label-inner">
                                    Bad (Below 580)
                                </div>
                            </label>
                        </div>

                        <button type="button" class="action-button previous previous_button" style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 16 -->
                        <h2><b>Great News</b> <br> You've been matched</h2>
                        <h6>Continue to the final steps so we can provide your personalized result</h6>


                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">See My Result</button>
                    </fieldset>

                    <fieldset><!-- Page 17 -->
                    <h2>What's your current street address?</h2>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="streetAddress">Street Address:</label>
                            <input id="streetAddress" class="form-control" type="text" name="street_address" placeholder="Enter Your Address">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="unitNumber">Unit#:</label>
                            <input id="unitNumber" class="form-control" type="text" name="unit" placeholder="Unit#">
                        </div>
                    </div>

                    <button type="button" class="action-button previous previous_button" style="margin-top: 50px;">Back</button>
                    <button type="button" class="next action-button">Continue</button>
                </fieldset>

                    <fieldset><!-- Page 18 -->
                        <h2>What Zip code is your home located in?</h2>
                        <div class="row justify-content-center">

                            <div class="col-8 col-sm-6 col-md-4">
                                <input class="form-control" type="text" name="zip_code" placeholder="Zip Code">
                            </div>
                        </div>

                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 19 -->
                        <h2>What is your full name?</h2>
                        <div class="row justify-content-center">

                            <div class="col-8 col-md-8">
                                <input class="form-control" type="text" name="full_name" placeholder="Enter your Full Name">
                            </div>
                        </div>

                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 20 -->
                        <h2>What is your Email Address?</h2>
                        <div class="row justify-content-center">

                            <div class="col-8 col-md-8">
                                <input class="form-control" type="email" name="email_address" placeholder="Enter your email">
                            </div>
                        </div>

                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="button" class="next action-button">Continue</button>
                    </fieldset>

                    <fieldset><!-- Page 21 -->
                        <h2>What is your Phone number?</h2>
                        <div class="row justify-content-center">
                            <div class="col-8 col-md-8">
                                <input class="form-control" type="number" name="phone_number" placeholder="Enter your phone number">
                            </div>
                        </div>

                        <button type="button" class="action-button previous previous_button"
                            style="margin-top: 50px;">Back</button>
                        <button type="Submit" class="next action-button">Submit</button>
                    </fieldset>
                </form>
                <footer class="credit text-start">
                    <h5 class="text-center">No login or SSN required. This will NOT affect your credit, and it takes
                        less than 1 minute to
                        complete!
                    </h5>
                    <hr>
                    <h5><span style="color: aqua;">IMPORTANT PRIVACY NOTICE:</span> YOUR INFORMATION WILL NOT BE SOLD TO
                        MULTIPLE
                        PARTIES</h5>
                    <p class="p-0">
                        Most online mortgage shopping experiences sell the information they collect to multiple mortgage
                        lenders,
                        banks, and other institutions. We don't. You’ll get connected with a top Crush Mortgage Advisor
                        that’s
                        licensed in your market, and YOU can decide the next steps from there.
                    </p>
                    <hr>
                    <p class="p-0">
                    <h5 class="fw-medium">IMPORTANT DISCLOSURES</h5>
                    Crush Mortgage Loans is a tradename of Rebel Mortgage, LLC, NMLS #282856 | This website is for
                    demo purposes
                    only
                    </p>
                </footer>
            </section>
        </article>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
          var rangeInput = document.getElementById('cash_out_amount');
          var rangeValueDisplay = document.getElementById('rangeValue');
    
          rangeInput.addEventListener('input', function() {
            rangeValueDisplay.textContent = rangeInput.value;
          });

          function increaseValue() {
            if (parseInt(rangeInput.value) < parseInt(rangeInput.max)) {
              rangeInput.value = parseInt(rangeInput.value) + 1;
              rangeValueDisplay.textContent = rangeInput.value;
            }
          }

          function decreaseValue() {
            if (parseInt(rangeInput.value) > parseInt(rangeInput.min)) {
              rangeInput.value = parseInt(rangeInput.value) - 1;
              rangeValueDisplay.textContent = rangeInput.value;
            }
          }

          document.getElementById('increaseButton').addEventListener('click', increaseValue);
          document.getElementById('decreaseButton').addEventListener('click', decreaseValue);
        });
      </script>

    <script>
        
        document.addEventListener("DOMContentLoaded", function () {
            var form = document.getElementById("myForm");
            var formElements = form.elements;

            for (var i = 0; i < formElements.length - 1; i++) {
                formElements[i].addEventListener("keypress", function (event) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                    }
                });
            }
        });


        document.addEventListener('DOMContentLoaded', function () {
            const nextButtons = document.querySelectorAll('.next');
            const prevButtons = document.querySelectorAll(".previous");

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
                    let isChecked = false;

                    if (radioInputs.length === 0) {
                        isChecked = true;
                    }
                    radioInputs.forEach(input => {
                        if (input.checked) {
                            isChecked = true;
                        }
                    });

                    if (isChecked) {
                        const nextFieldset = fieldset.nextElementSibling;
                        if (nextFieldset) {
                            fieldset.style.display = 'none';
                            nextFieldset.style.display = 'block';
                        }
                    } else {
                        alert('Please select an option');
                    }
                });
            });
        });


    </script>
</body>

</html>