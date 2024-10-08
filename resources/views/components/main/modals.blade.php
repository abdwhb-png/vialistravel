<div>
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
</div>@php
    $privacyPolicy = '/legal/privacy-policy';
    $submitRoute = route('modal-form');
@endphp
<input type="radio" modal-toggle name="modal-toggle" id="modal-catalog" js="catalog-toggle" />
<div modal="catalog">
    <div catalog-stage>
        <div catalog-body>
            <!-- Close X  -->
            <label catalog-form-close for="modal-reset" hide="sm" js-click-toggle></label>

            <!-- Header - Mobile Only -->
            <div catalog-header hide="md+">
                <p catalog-header-title enso>Request Your {{ date('Y') . '/' . date('Y') + 1 }} Catalog</p>
                <label catalog-header-close for="modal-reset" js-click-toggle></label>
            </div>

            <!-- Aside - Desktop Only -->
            <div catalog-aside hide="sm!" enso>

                <div catalog-aside-headlines>
                    <p catalog-aside-headline="small">Discover the World's Best</p>
                    <p catalog-aside-headline="large">Nature Travel Experiences</p>
                </div>
                <img catalog-aside-image src="/uploaded-files/_global/catalog-2024-3D.jpg" alt="Nathab 2024 Catalog" />
                <div catalog-aside-content>
                    <p catalog-aside-text>Together, {{ $site_name }} and World Wildlife Fund have teamed
                        up to arrange nearly a hundred nature travel experiences around the planet, while helping to
                        protect the magnificent places we visit and their wild inhabitants.</p>
                    <div catalog-aside-logos>
                        <img catalog-aside-logo="nathab" src="{{ $site_settings->site_logo }}"
                            alt="{{ $site_name }} Logo" />
                        <img catalog-aside-logo="wwf" src="/uploaded-files/logos/logo-wwf.png" alt="WWF Logo" />
                    </div>
                </div>

            </div>

            <!-- Form -->
            <div catalog-form>
                <form id="form-catalog" name="form-catalog" action="{{ $submitRoute . '/get-catalog' }}" method="post">
                    @csrf
                    <div catalog-form-required class="js-catalog-required">
                        <div catalog-form-headline hide="sm">
                            <div catalog-form-headline-title enso>Request Your {{ date('Y') . '/' . date('Y') + 1 }}
                                Catalog</div>
                        </div>
                        <div catalog-form-field="1/2">
                            <label catalog-form-label="required" for="form-catalog-first_name">First Name</label>
                            <input catalog-form-input="text" type="text" js-format-name name="first_name"
                                id="form-catalog-first_name" mrkto-field="#FirstName" required />
                        </div>
                        <div catalog-form-field="1/2">
                            <label catalog-form-label="required" for="form-catalog-last_name">Last Name</label>
                            <input catalog-form-input="text" type="text" js-format-name name="last_name"
                                id="form-catalog-last_name" mrkto-field="#LastName" required />
                        </div>
                        <div catalog-form-field="3/4">
                            <label catalog-form-label="required" for="form-catalog-home_street">Address</label>
                            <input catalog-form-input="text" type="text" name="home_street"
                                id="form-catalog-home_street" mrkto-field="#Address" class="js-smarty-street"
                                autocomplete="new-password" required />
                            <div smarty="menu" class="js-smarty-menu"></div>
                        </div>
                        <div catalog-form-field="1/4 start">
                            <label catalog-form-label for="form-catalog-home_street_2">Suite</label>
                            <input catalog-form-input="text" type="text" name="home_street_2"
                                id="form-catalog-home_street_2" mrkto-field="#addressLine2" class="js-smarty-street-2"
                                autocomplete="new-password" />
                        </div>
                        <div catalog-form-field="1/2">
                            <label catalog-form-label="required" for="form-catalog-home_city">City</label>
                            <input catalog-form-input="text" type="text" name="home_city" id="form-catalog-home_city"
                                mrkto-field="#City" class="js-smarty-city" autocomplete="new-password" required />
                        </div>
                        <div catalog-form-field="1/4">
                            <label catalog-form-label="" for="form-catalog-home_state">State</label>
                            <input catalog-form-input="text" type="text" name="home_state"
                                id="form-catalog-home_state" mrkto-field="#State" class="js-smarty-state" />
                        </div>
                        <div catalog-form-field="1/4">
                            <label catalog-form-label="" for="form-catalog-home_zip">Postal</label>
                            <input catalog-form-input="text" type="text" name="home_zip" id="form-catalog-home_zip"
                                mrkto-field="#PostalCode" class="js-smarty-zip" />
                        </div>
                        <div catalog-form-field="1/2">
                            <label catalog-form-label="required" for="form-catalog-home_country">Country</label>
                            <input catalog-form-input="text" type="text" name="home_country"
                                id="form-catalog-country" mrkto-field="#Country" class="js-smarty-country"
                                list="country-list" autocomplete="new-password" required />
                            <datalist id="country-list">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of
                                </option>
                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba
                                </option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                </option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, the Democratic Republic of the">Congo, the Democratic
                                    Republic of the</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curaçao">Curaçao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands
                                </option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                                </option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's
                                    Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic
                                </option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former
                                    Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of
                                </option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied
                                </option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Réunion">Réunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Barthélemy">Saint Barthélemy</option>
                                <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena,
                                    Ascension and Tristan da Cunha</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                </option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the
                                    South Sandwich Islands</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying
                                    Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of
                                </option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </datalist>

                        </div>
                        <div catalog-form-field="1/2">
                            <label catalog-form-label for="form-catalog-phone">Phone</label>
                            <input catalog-form-input="tel" type="tel" js-format-phone
                                placeholder="(123) 456-7890" name="phone" id="form-catalog-phone"
                                mrkto-field="#Phone" js-catalog-phone-toggle />
                        </div>
                        <div catalog-form-field="100%">
                            <label catalog-form-label="required" for="email">Email</label>
                            <input catalog-form-input="email" type="email" name="email" id="form-catalog-email"
                                mrkto-field="#Email" required />
                        </div>
                        <div catalog-form-field="100% checkbox">
                            <input catalog-form-input="checkbox" type="checkbox"
                                name="form-catalog-requestNewsletter" id="form-catalog-requestNewsletter"
                                class="js-set-by-country" />
                            <label catalog-form-label="checkbox optin enews divider"
                                for="form-catalog-requestNewsletter" enso>
                                <span>Sign up to receive our travel emails!</span>
                                <a catalog-form-privacy href="{{ $privacyPolicy }}" target="_blank">Privacy
                                    Policy</a>
                            </label>
                        </div>
                        <div catalog-form-field="100% sms checkbox" class="hide js-sms-checkbox-catalog">
                            <input catalog-form-input="sms checkbox" type="checkbox" name="form-catalog-Optin-SMS"
                                id="form-catalog-Optin-SMS" js-catalog-sms />
                            <label catalog-form-label="checkbox optin" for="form-catalog-Optin-SMS" enso>
                                <span>Sign up to receive promotional and informational text messages about our
                                    trips</span>
                            </label>
                            <div catalog-sms-privacy-wrapper enso>
                                <a catalog-form-privacy href="#privacy-policy/promotional-sms#" target="_blank">Text
                                    Messaging Policy</a>
                                <span catalog-sms-fine-print js-show-for-admin="inline">Message and data rates may
                                    apply. You can unsubscribe from SMS at any time by texting STOP. Reply HELP for
                                    help. 2-4 promotional msgs/month. Informational msg frequency varies.</span>
                            </div>
                        </div>
                        <div catalog-form-field="100% button">
                            <button catalog-form-button id="form-catalog-catalog-optional"
                                class="js-catalog-button-optional" test="catalog-screen-2"
                                type="submit">Submit</button>
                        </div>
                        {{-- <div catalog-form-field="1/2 button">
                            <button catalog-form-button id="form-catalog-catalog-required"
                                class="js-catalog-button-required" test="catalog-screen-1" type="submit">Request
                                Catalog</button>
                        </div> --}}
                    </div>
                    <div catalog-form-optional class="js-catalog-optional hide">
                        <div catalog-form-headline>
                            <div catalog-form-headline-text><strong>Continued - Page 2 of 2</strong><br />To help us
                                customize your catalog request, please tell us more about your travel needs:</div>
                        </div>

                        <div catalog-form-field="1/2">
                            <label catalog-form-label for="form-catalog-find-nathab">How did you hear about
                                us?</label>
                            <select catalog-form-input="select" data-placeholder="Please Select"
                                class="js-show-hide-who-referred" id="form-catalog-find-nathab"
                                mrkto-field="#temp8CatReferralSource" name="form-catalog-find-nathab">
                                <option selected="Please Select" selected value="">Please Select</option>
                                <option value="Friend">Friend</option>
                                <option value="Guidebook">Guidebook</option>
                                <option value="Magazine Ad">Magazine Ad</option>
                                <option value="{{ $site_name }} eNewsletter">{{ $site_name }} eNewsletter
                                </option>
                                <option value="Newspaper">Newspaper</option>
                                <option value="Internet Search">Search Engine</option>
                                <option value="Social Network (Facebook, Instagram, etc.)">Social Network
                                    (Facebook, Instagram, etc.)</option>
                                <option value="Travel Consultant">Travel Consultant</option>
                                <option value="Another Website">Website</option>
                                <option value="WWF">WWF</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div catalog-form-field="1/2" class="js-show-hide-me hide">
                            <label catalog-form-label for="form-catalog-friend-referral">Who referred you?</label>
                            <input catalog-form-input="text" type="text" name="form-catalog-friend-referral"
                                mrkto-field="#temp9CatReferralName" id="form-catalog-friend-referral" />
                        </div>

                        <div catalog-form-field="100%">
                            <label catalog-form-label for="form-catalog-destinations-of-interest">Which
                                destinations interests you most? <span class="block-on-mobile smaller">(Select up
                                    to three)</span></label>
                            <fieldset catalog-form-field-list="checkbox 2-column" js-limit="3">
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-africa"
                                        name="destination-africa" type="checkbox" mrkto-checkbox="#interestinAfrica"
                                        value="true" />
                                    <label catalog-form-label="checkbox" for="form-catalog-destination-africa">African
                                        Safaris</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-northern"
                                        name="destination-northern" type="checkbox"
                                        mrkto-checkbox="#interestinAlaskaNorth" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-northern">Alaska & the North</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-antarctica"
                                        name="destination-antarctica" type="checkbox"
                                        mrkto-checkbox="#interestinPolar" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-antarctica">Antarctica & Polar
                                        Adventures</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-asia-pacific"
                                        name="destination-asia-pacific" mrkto-checkbox="#interestinAsiaPacific"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-asia-pacific">Asia & the Pacific</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-europe"
                                        name="destination-europe" type="checkbox" mrkto-checkbox="#interestinEurope"
                                        value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-europe">European Nature Adventures</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-galapagos"
                                        name="destination-galapagos" type="checkbox"
                                        mrkto-checkbox="#interestinGalapagos" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-galapagos">Galapagos Islands</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-central-america"
                                        name="destination-central-america" mrkto-checkbox="#interestinCentralAmerica"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-central-america">Mexico & Central
                                        America</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-polar-bears"
                                        name="destination-polar-bears" type="checkbox"
                                        mrkto-checkbox="#interestinPolarBears" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-polar-bears">Polar Bear Tours</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-south-america"
                                        name="destination-south-america" mrkto-checkbox="#interestinSouthAmerica"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-south-america">South America</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-destination-national-parks"
                                        name="destination-national-parks" mrkto-checkbox="#interestinUSNatlParks"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-destination-national-parks">U.S. National Parks</label>
                                </div>
                            </fieldset>
                        </div>

                        <div catalog-form-field="100%">
                            <label catalog-form-label for="form-catalog-destinations-of-interest">What type of
                                travel interests you most? <span class="block-on-mobile smaller">(Select up to
                                    two)</span></label>
                            <fieldset catalog-form-field-list="checkbox 2-column" js-limit="2">
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-interest-hiking-kayaking"
                                        name="interest-hiking-kayaking" mrkto-checkbox="#interestinActive"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-interest-hiking-kayaking">Active hiking & kayaking
                                        adventures</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-interest-cruising"
                                        name="interest-cruising" type="checkbox" mrkto-checkbox="#interestinCruises"
                                        value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-interest-cruising">Adventure cruising aboard expedition
                                        ships</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-interest-custom"
                                        name="interest-custom" type="checkbox" mrkto-checkbox="#interestinCustom"
                                        value="true" />
                                    <label catalog-form-label="checkbox" for="form-catalog-interest-custom">Custom
                                        adventures for a private
                                        group</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-interest-general-nature"
                                        name="interest-general-nature" mrkto-checkbox="#interestinGeneralNature"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-interest-general-nature">General nature & wildlife
                                        viewing</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-interest-family"
                                        name="interest-family" type="checkbox" mrkto-checkbox="#interestinFamily"
                                        value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-interest-family">Multi-generational nature
                                        adventures</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-interest-nature-photography"
                                        name="interest-nature-photography" mrkto-checkbox="#interestinPhoto"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-interest-nature-photography">Specialized nature
                                        photography adventures</label>
                                </div>
                            </fieldset>
                        </div>

                        <div catalog-form-field="100%">
                            <label catalog-form-label for="form-catalog-destinations-of-interest">Where have you
                                traveled previously?</label>

                            <div catalog-form-field-list="checkbox 4-column">
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-previously-traveled-africa"
                                        name="previously-traveled-africa" mrkto-checkbox="#previousTravelinAfrica"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox" for="form-catalog-previously-traveled-africa"
                                        value="africa">Africa</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-previously-traveled-alaska"
                                        name="previously-traveled-alaska" mrkto-checkbox="#previousTravelinAlaska"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-alaska">Alaska</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox"
                                        id="form-catalog-previously-traveled-antarctica"
                                        name="previously-traveled-antarctica"
                                        mrkto-checkbox="#previousTravelinAntarctica" type="checkbox"
                                        value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-antarctica">Antarctica</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-previously-traveled-arctic"
                                        name="previously-traveled-arctic" mrkto-checkbox="#previousTravelinArctic"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-arctic">Arctic</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox" id="form-catalog-previously-traveled-asia"
                                        name="previously-traveled-asia" mrkto-checkbox="#previousTravelinAsia"
                                        type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-asia">Asia</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox"
                                        id="form-catalog-previously-traveled-central-america"
                                        name="previously-traveled-central-america"
                                        mrkto-checkbox="#previousTravelinCentralAmerica" type="checkbox"
                                        value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-central-america">Central
                                        America</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox"
                                        id="form-catalog-previously-traveled-galapagos"
                                        name="previously-traveled-galapagos"
                                        mrkto-checkbox="#previousTravelinGalapagos" type="checkbox" value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-galapagos">Galapagos</label>
                                </div>
                                <div catalog-form-field="checkbox">
                                    <input catalog-form-input="checkbox"
                                        id="form-catalog-previously-traveled-south-america"
                                        name="previously-traveled-south-america"
                                        mrkto-checkbox="#previousTravelinSouthAmerica" type="checkbox"
                                        value="true" />
                                    <label catalog-form-label="checkbox"
                                        for="form-catalog-previously-traveled-south-america">South America</label>
                                </div>
                            </div>
                        </div>

                        <div catalog-form-field="1/2">
                            <label catalog-form-label for="form-catalog-trip-budget">What is your per-person
                                budget?</label>
                            <select catalog-form-input="select" data-placeholder="Please Select"
                                id="form-catalog-trip-budget" mrkto-field="#temp11CatBudget" name="trip-budget">
                                <option value="" selected>Please Select</option>
                                <option value="$0-$2500">$0-$2500</option>
                                <option value="$2500-$3500">$2500-$3500</option>
                                <option value="$3500-$5000">$3500-$5000</option>
                                <option value="$5000-$7500">$5000-$7500</option>
                                <option value="$7500-$10000">$7500-$10000</option>
                                <option value="$10000 or over">$10000 or over</option>
                            </select>
                        </div>

                        <div catalog-form-field="1/2">
                            <label catalog-form-label for="form-catalog-itinRequest">Is there a specific region of
                                interest?</label>
                            <input catalog-form-input="text" id="form-catalog-itinRequest" name="itinRequest"
                                mrkto-field="#temp13CatTripSpecifics" />
                        </div>

                        <div catalog-form-field="1/2">
                            <label catalog-form-label for="form-catalog-seasonYearInfo">When do you plan to
                                travel?</label>
                            <input catalog-form-input="text" type="text" name="seasonYearInfo"
                                id="form-catalog-seasonYearInfo" mrkto-field="#temp12CatAvailability" />
                        </div>

                        <div catalog-form-field="1/2">
                            <label catalog-form-label for="form-catalog-party-size">How many people are in your
                                party?</label>
                            <input catalog-form-input="text" type="text" inputmode="numeric" pattern="[0-9]*"
                                name="party-size" id="form-catalog-party-size" mrkto-field="#temp10CatPartySize" />
                        </div>

                        <div catalog-form-field="100%">
                            <label catalog-form-label for="form-catalog-travel-frequency">How often do you
                                vacation abroad?</label>
                            <div catalog-form-field-list="radio">
                                <div catalog-form-field="radio">
                                    <input catalog-form-input="radio" id="form-catalog-travel-frequency-once"
                                        name="travel-frequency" type="radio" value="Once a Year" />
                                    <label catalog-form-label="radio" for="form-catalog-travel-frequency-once">Once a
                                        year</label>
                                </div>
                                <div catalog-form-field="radio">
                                    <input catalog-form-input="radio" id="form-catalog-travel-frequency-multiple"
                                        name="travel-frequency" type="radio" value="Multiple Times a Year" />
                                    <label catalog-form-label="radio"
                                        for="form-catalog-travel-frequency-multiple">Multiple times a year</label>
                                </div>
                                <div catalog-form-field="radio">
                                    <input catalog-form-input="radio" id="form-catalog-travel-frequency-seldom"
                                        name="travel-frequency" type="radio" value="Every 2 - 3 Years" />
                                    <label catalog-form-label="radio" for="form-catalog-travel-frequency-seldom">Every
                                        2 - 3 years</label>
                                </div>
                                <div catalog-form-field="radio">
                                    <input catalog-form-input="radio" id="form-catalog-travel-frequency-rarely"
                                        name="travel-frequency" type="radio" value="Rarely" />
                                    <label catalog-form-label="radio"
                                        for="form-catalog-travel-frequency-rarely">Rarely</label>
                                </div>
                            </div>
                        </div>

                        <div catalog-form-field="100%">
                            <label catalog-form-label for="form-catalog-company_name">If you’re a travel
                                consultant, what is your agency’s name?</label>
                            <input catalog-form-input="text" type="text" name="form-catalog-company"
                                id="form-catalog-company_name" mrkto-field="#Company" />
                        </div>

                        <div catalog-form-field="100% button">
                            <button catalog-form-button id="form-catalog-catalog-optional"
                                class="js-catalog-button-optional" test="catalog-screen-2"
                                type="submit">Submit</button>
                        </div>
                    </div>
                    <div catalog-form-thankyou class="js-catalog-thankyou hide">
                        <div catalog-form-headline test-modal-catalog-form enso>Thank you for requesting a catalog
                        </div>
                        <div catalog-form-thankyou-text="thankyou" enso>We&rsquo;ve received your request. If you
                            have any questions about our trips, please feel free to contact an Adventure Specialist
                            today by calling 800-543-8917.</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="radio" modal-toggle name="modal-toggle" id="modal-enews" js="enews-toggle" />
<div modal="enews">
    <div enews-stage>
        <div enews-body>
            <!-- Close X  -->
            <label enews-form-close for="modal-reset" hide="sm" js-click-toggle></label>

            <!-- Header - Mobile Only -->
            <div enews-header hide="md+">
                <p enews-header-title enso>Send Me Travel Emails</p>
                <label enews-header-close for="modal-reset" js-click-toggle></label>
            </div>

            <!-- Aside - Desktop Only -->
            <div enews-aside hide="sm!" enso>

                <div enews-aside-headlines>
                    <p enews-aside-headline="small">Discover the World's Best</p>
                    <p enews-aside-headline="large">Nature Travel Experiences</p>
                </div>
                <div enews-aside-image-container>
                    <!-- prettier-ignore -->
																<img enews-aside-image src='uploaded-files/_global/thumbnail-enews-v11.png' alt="" />
                    <div class="icon-enews animated fadeInLeft" style="--badge-text: 'eNews'"></div>
                </div>
                <div enews-aside-content>
                    <p enews-aside-text>Our weekly eNewsletter highlights new adventures, exclusive offers,
                        webinars, nature news, travel ideas, photography tips and more. Sign up today!</p>
                    <div enews-aside-logos>
                        <img enews-aside-logo="wwf" src="/uploaded-files/logos/logo-wwf.png" alt="WWF Logo" />
                    </div>
                </div>

            </div>

            <!-- Form -->
            <div enews-form>
                <!-- onsubmit return false necessary, don't delete it -->
                <form id="form-enews" name="form-enews" action="{{ $submitRoute . '/subscribe-to-enews' }}"
                    method="post">
                    @csrf
                    <div enews-form-required class="js-enews-required">
                        <div enews-form-headline hide="sm">
                            <div enews-form-headline-title enso>Send Me Travel Emails</div>
                        </div>
                        <div enews-form-field="50%">
                            <label enews-form-label="required" for="form-enews-first_name">First Name</label>
                            <input enews-form-input="text" type="text" js-format-name name="first_name"
                                id="form-enews-first_name" mrkto-field="#FirstName" required />
                        </div>
                        <div enews-form-field="50%">
                            <label enews-form-label="required" for="form-enews-last_name">Last Name</label>
                            <input enews-form-input="text" type="text" js-format-name name="last_name"
                                id="form-enews-last_name" mrkto-field="#LastName" required />
                        </div>
                        <div enews-form-field="50%">
                            <label enews-form-label="required" for="email">Email</label>
                            <input enews-form-input="email" type="email" name="email" id="form-enews-email"
                                mrkto-field="#Email" required />
                        </div>
                        <div enews-form-field="50%">
                            <label enews-form-label for="form-enews-phone">Phone</label>
                            <input enews-form-input="tel" type="tel" js-format-phone placeholder="(123) 456-7890"
                                name="phone" id="form-enews-phone" mrkto-field="#Phone" js-enews-phone-toggle />
                        </div>
                        <div enews-form-field="100% checkbox" class="hide js-sms-checkbox-enews">
                            <input enews-form-input="checkbox" type="checkbox" name="form-enews-Optin-SMS"
                                id="form-enews-Optin-SMS" js-enews-sms />
                            <label enews-form-label="checkbox optin" for="form-enews-Optin-SMS" enso>
                                <span>
                                    Sign up to receive promotional and informational text messages about our trips
                                </span>
                            </label>
                            <div enews-sms-privacy-wrapper enso>
                                <a enews-form-privacy="sms" href="#privacy-policy/promotional-sms#"
                                    target="_blank">Text Messaging Policy</a>
                                <span enews-sms-fine-print js-show-for-admin="inline">Message and data rates may
                                    apply. You can unsubscribe from SMS at any time by texting STOP. Reply HELP for
                                    help. 2-4 promotional msgs/month. Informational msg frequency varies.</span>
                            </div>
                        </div>
                        <div enews-form-field="100% button" enso>
                            <button enews-form-button id="form-enews-enews-required" class="js-enews-button-required"
                                test="enews-submit" type="submit">Sign
                                Up</button>
                            <a enews-form-privacy href="{{ $privacyPolicy }}" target="_blank"
                                rel="noreferrer">Privacy Policy</a>
                        </div>
                    </div>
                    <div enews-form-thankyou class="js-enews-thankyou hide">
                        <div enews-form-headline>
                            <div enews-form-thankyou-text="thankyou">
                                <strong test-modal-enews-form enso>Thank you for joining our email list!</strong>
                                <p enso>Look for a special welcome message in your inbox, arriving shortly! Be sure
                                    to add <a href="mailto:naturalhabitat@nathab.com">naturalhabitat@nathab.com</a>
                                    to
                                    your email contacts so you don&rsquo;t miss out on future emails.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<label for="modal-message" class="hide" js-message-location="URL"></label>
<input type="radio" modal-toggle name="modal-toggle" id="modal-message" js="message-toggle" />
<div modal="message">
    <div message-stage>
        <div message-body>
            <!-- Close X  -->
            <label message-form-close for="modal-reset" hide="sm" js-click-toggle></label>

            <!-- Header - Mobile Only -->
            <div message-header hide="md+">
                <p message-header-title enso>Send Us a Message</p>
                <label message-header-close for="modal-reset" js-click-toggle></label>
            </div>

            <!-- Aside - Desktop Only -->
            <div message-aside hide="sm!" enso>

                <div message-aside-headlines>
                    <p message-aside-headline="small"></p>
                    <p message-aside-headline="large">Send Us a Message</p>
                </div>
                <div message-aside-content>
                    <p message-aside-text>Have a question or comment? Use the form to the right to get in touch with
                        us.</p>
                    <div message-aside-logos>
                        <img message-aside-logo="nathab" src="{{ $site_settings->site_logo }}"
                            alt="{{ $site_name }} Logo" />
                        <img message-aside-logo="wwf" src="/uploaded-files/logos/logo-wwf.png" alt="WWF Logo" />
                    </div>
                </div>

            </div>

            <!-- Form -->
            <div message-form>
                <form id="form-message" name="form-message" action="{{ $submitRoute . '/contact' }}"
                    method="post">
                    @csrf
                    <div message-form-required class="js-message-required">
                        <div message-form-headline hide="sm">
                            <div message-form-headline-title enso>Send Us a Message</div>
                        </div>
                        <div message-form-field="1/2">
                            <label message-form-label="required" for="form-message-first_name">First
                                Name</label>
                            <input message-form-input="text" type="text" js-format-name name="first_name"
                                id="form-message-first_name" mrkto-field="#FirstName" required />
                        </div>
                        <div message-form-field="1/2">
                            <label message-form-label="required" for="form-message-last_name">Last Name</label>
                            <input message-form-input="text" type="text" js-format-name name="last_name"
                                id="form-message-last_name" mrkto-field="#LastName" required />
                        </div>
                        <div message-form-field="1/2">
                            <label message-form-label="required" for="email">Email</label>
                            <input message-form-input="email" type="email" name="email" id="form-message-email"
                                mrkto-field="#Email" required />
                        </div>
                        <div message-form-field="1/2">
                            <label message-form-label for="form-message-phone">Phone</label>
                            <input message-form-input="tel" type="tel" js-format-phone
                                placeholder="(123) 456-7890" name="phone" id="form-message-phone"
                                mrkto-field="#Phone" js-message-phone-toggle />
                        </div>
                        <div message-form-field="100%">
                            <label message-form-label="required" for="email">Your Message</label>
                            <textarea message-form-input="textarea" type="email" name="messageaQuestionText"
                                id="form-message-messageaQuestionText" mrkto-field="#message" required></textarea>
                        </div>
                        <div message-form-field="100%">
                            <label message-form-label for="form-message-find-nathab">How did you hear about
                                us?</label>
                            <select message-form-input="select" data-placeholder="Please Select"
                                id="form-message-find-nathab" mrkto-field="#temp8CatReferralSource"
                                name="form-message-find-nathab">
                                <option selected="Please Select" selected value="">Please Select</option>
                                <option value="Friend">Friend</option>
                                <option value="Guidebook">Guidebook</option>
                                <option value="Magazine Ad">Magazine Ad</option>
                                <option value="{{ $site_name }} eNewsletter">{{ $site_name }} eNewsletter
                                </option>
                                <option value="Newspaper">Newspaper</option>
                                <option value="Internet Search">Search Engine</option>
                                <option value="Social Network (Facebook, Instagram, etc.)">Social Network
                                    (Facebook, Instagram, etc.)</option>
                                <option value="Travel Consultant">Travel Consultant</option>
                                <option value="Another Website">Website</option>
                                <option value="WWF">WWF</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div message-form-field="100% sms checkbox" class="hide js-sms-checkbox-message">
                            <input message-form-input="sms checkbox" type="checkbox" name="form-message-Optin-SMS"
                                id="form-message-Optin-SMS" js-message-sms />
                            <label message-form-label="checkbox optin" for="form-message-Optin-SMS" enso>
                                <span>
                                    Sign up to receive promotional and informational text messages about our trips
                                </span>
                            </label>
                            <div message-sms-privacy-wrapper enso>
                                <a message-form-privacy href="#privacy-policy/promotional-sms#" target="_blank">Text
                                    Messaging Policy</a>
                                <span message-sms-fine-print js-show-for-admin="inline">Message and data rates may
                                    apply. You can unsubscribe from SMS at any time by texting STOP. Reply HELP for
                                    help. 2-4 promotional msgs/month. Informational msg frequency varies.</span>
                            </div>
                        </div>
                        <div message-form-field="100% checkbox">
                            <input message-form-input="checkbox" type="checkbox"
                                name="form-message-requestNewsletter" id="form-message-requestNewsletter"
                                class="js-set-by-country" />
                            <label message-form-label="checkbox optin divider" for="form-message-requestNewsletter"
                                enso>
                                <span>
                                    Sign up to receive our travel emails!
                                </span>
                                <a message-form-privacy href="{{ $privacyPolicy }}" target="_blank">Privacy
                                    Policy</a>
                            </label>
                        </div>
                        <div message-form-field="100% sms checkbox" class="hide js-sms-checkbox-message">
                            <input message-form-input="sms checkbox" type="checkbox" name="form-message-Optin-SMS"
                                id="form-message-Optin-SMS" js-message-sms />
                            <label message-form-label="checkbox optin" for="form-message-Optin-SMS" enso>
                                <span>
                                    Sign up to receive promotional and informational text messages about our trips
                                </span>
                            </label>
                            <div message-sms-privacy-wrapper enso>
                                <a message-form-privacy href="#privacy-policy/promotional-sms#" target="_blank">Text
                                    Messaging Policy</a>
                                <span message-sms-fine-print js-show-for-admin="inline">Message and data rates may
                                    apply. You can unsubscribe from SMS at any time by texting STOP. Reply HELP for
                                    help. 2-4 promotional msgs/month. Informational msg frequency varies.</span>
                            </div>
                        </div>
                        <div message-form-field="100% button">
                            <button message-form-button id="form-message-itinerary-required"
                                class="js-message-button-required" test="message-submit" type="submit">Send
                                Message</button>
                        </div>
                    </div>
                    <div message-form-thankyou class="js-message-thankyou hide">
                        <div message-form-headline>
                            <div message-form-thankyou-text="thankyou">
                                <strong test-modal-message-form enso enso>Thank you for your message</strong>
                                <p enso>We&rsquo;ll be in touch soon with a response.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<label for="modal-refer" class="hide" js-refer-location="URL"></label>
<input type="radio" modal-toggle name="modal-toggle" id="modal-refer" js="refer-toggle" />
<div modal="refer">
    <div refer-stage>
        <div refer-body>
            <!-- Close X  -->
            <label refer-form-close for="modal-reset" hide="sm" js-click-toggle></label>

            <!-- Header - Mobile Only -->
            <div refer-header hide="md+">
                <p refer-header-title enso>Refer a Friend</p>
                <label refer-header-close for="modal-reset" js-click-toggle></label>
            </div>

            <!-- Aside - Desktop Only -->
            <div refer-aside hide="sm!">
                <div refer-aside-headlines>
                    <div refer-aside-headline="small" enso></div>
                    <div refer-aside-headline="large" enso>Refer a Friend,<br>Get $250 Off</div>
                </div>
                <div refer-aside-content>
                    <div refer-aside-text enso>Earn rewards for referring your friends! We'd like to thank our loyal
                        travelers for spreading the word. Share your friend's address so we can send a catalog, and
                        if your friend takes a trip as a first-time {{ $site_name }} traveler, you'll receive a $250
                        {{ $site_name }}
                        credit you can use toward a future trip or the purchase of {{ $site_name }} gear. To refer a
                        friend,
                        just complete the form below or call us at 800-543-8917. It's that easy! <a
                            href="traveler-resources/habitat-club/rules#" target="_blank">See rules
                            and fine print here.</a></div>
                    <div refer-aside-logos>
                        <img refer-aside-logo="nathab" src="{{ $site_settings->site_logo }}"
                            alt="{{ $site_name }} Logo" />
                        <img refer-aside-logo="wwf" src="/uploaded-files/logos/logo-wwf.png" alt="WWF Logo" />
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div refer-form>
                <form id="form-refer" name="form-refer" action="{{ $submitRoute . '/refer-a-friend' }}"
                    method="post">
                    @csrf
                    <div refer-form-required class="js-refer-required">
                        <div refer-form-headline hide="sm">
                            <div refer-form-headline-title enso>Refer a Friend</div>
                        </div>
                        <p refer-form-text hide="md+">Earn rewards for referring your friends! We'd like to
                            thank our loyal travelers for spreading the word. Share your friend's address so we can
                            send a catalog, and if your friend takes a trip as a first-time {{ $site_name }}
                            traveler, you'll
                            receive a $250 {{ $site_name }} credit you can use toward a future trip or the purchase
                            of Nat
                            Hab gear. To refer a friend, just complete the form below or call us at 800-543-8917.
                            It's that easy! <a href="traveler-resources/habitat-club/rules#" target="_blank">See rules
                                and fine print here.</a></p>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="form-refer-first_name">Your First
                                Name</label>
                            <input refer-form-input="text" type="text" js-format-name name="first_name"
                                id="form-refer-first_name" mrkto-field="#FirstName" required />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="form-refer-last_name">Your Last Name</label>
                            <input refer-form-input="text" type="text" js-format-name name="last_name"
                                id="form-refer-last_name" mrkto-field="#LastName" required />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="email">Your Email</label>
                            <input refer-form-input="email" type="email" name="email" id="form-refer-email"
                                mrkto-field="#Email" required />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label for="form-refer-phone">Phone</label>
                            <input refer-form-input="tel" type="tel" js-format-phone
                                placeholder="(123) 456-7890" name="phone" id="form-refer-phone"
                                mrkto-field="#Phone" js-refer-phone-toggle />
                        </div>
                        <div refer-form-field="100% checkbox">
                            <input refer-form-input="checkbox" type="checkbox" name="form-refer-requestNewsletter"
                                id="form-refer-requestNewsletter" class="js-set-by-country" />
                            <datalist id="country-list">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of
                                </option>
                                <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba
                                </option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory
                                </option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, the Democratic Republic of the">Congo, the Democratic
                                    Republic of the</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Curaçao">Curaçao</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and McDonald Islands">Heard Island and McDonald
                                    Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)
                                </option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's
                                    Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic
                                </option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libya">Libya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former
                                    Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of
                                </option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied
                                </option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Réunion">Réunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Barthélemy">Saint Barthélemy</option>
                                <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena,
                                    Ascension and Tristan da Cunha</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                </option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the
                                    South Sandwich Islands</option>
                                <option value="South Sudan">South Sudan</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-Leste">Timor-Leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying
                                    Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic
                                    of</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </datalist>

                            <label refer-form-label="checkbox optin divider" for="form-refer-requestNewsletter"
                                enso>
                                <span>
                                    Sign up to receive our travel emails!
                                </span>
                                <a refer-form-privacy href="{{ $privacyPolicy }}" target="_blank">Privacy
                                    Policy</a>
                            </label>
                        </div>
                        <div refer-form-field="100% sms checkbox" class="hide js-sms-checkbox-refer">
                            <input refer-form-input="sms checkbox" type="checkbox" name="form-refer-Optin-SMS"
                                id="form-refer-Optin-SMS" js-refer-sms />
                            <div refer-form-sms-text-wrapper>
                                <label refer-form-label="checkbox optin divider" for="form-refer-Optin-SMS" enso>
                                    <span>
                                        Sign up to receive promotional and informational text messages about our
                                        trips
                                    </span>
                                </label>
                                <div refer-sms-privacy-wrapper enso>
                                    <a refer-form-privacy href="#privacy-policy/promotional-sms#"
                                        target="_blank">Text Messaging Policy</a>
                                    <span refer-sms-fine-print js-show-for-admin="inline">Message and data rates
                                        may apply. You can unsubscribe from SMS at any time by texting STOP. Reply
                                        HELP for help. 2-4 promotional msgs/month. Informational msg frequency
                                        varies.</span>
                                </div>
                            </div>
                        </div>
                        <div refer-form-field="100%" divider></div>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="form-refer-friend-first_name">Friend's First
                                Name</label>
                            <input refer-form-input="text" type="text" name="friend-First"
                                id="form-refer-friend-first_name" mrkto-field="#friendFirstName"
                                autocomplete="new-password" required />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="form-refer-friend-last_name">Friend's Last
                                Name</label>
                            <input refer-form-input="text" type="text" name="friend-Last"
                                id="form-refer-friend-last_name" mrkto-field="#friendLastName"
                                autocomplete="new-password" required />
                        </div>
                        <div refer-form-field="3/4">
                            <label refer-form-label="required" for="form-refer-friend-home_street">Friend's
                                Address</label>
                            <input refer-form-input="text" type="text" name="friend-home_street"
                                id="form-refer-friend-home_street" mrkto-field="#friendAddress"
                                class="js-smarty-street" autocomplete="new-password" required />
                            <div smarty="menu" class="js-smarty-menu"></div>
                        </div>
                        <div refer-form-field="1/4 start">
                            <label refer-form-label for="form-refer-refer-friend">Friend's Suite</label>
                            <input refer-form-input="text" type="text" name="friend-home_street_2"
                                id="form-refer-refer-friend" mrkto-field="#friendAddressLine2"
                                class="js-smarty-street-2" autocomplete="new-password" />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="form-refer-friend-home_city">Friend's
                                City</label>
                            <input refer-form-input="text" type="text" name="friend-home_city"
                                id="form-refer-friend-home_city" mrkto-field="#friendCity" class="js-smarty-city"
                                autocomplete="new-password" required />
                        </div>
                        <div refer-form-field="1/4">
                            <label refer-form-label="required" for="form-refer-friend-home_state">Friend's
                                State</label>
                            <input refer-form-input="text" type="text" name="friend-home_state"
                                id="form-refer-friend-home_state" mrkto-field="#friendState"
                                class="js-smarty-state" autocomplete="new-password" required />
                        </div>
                        <div refer-form-field="1/4">
                            <label refer-form-label="required" for="form-refer-friend-home_zip">Friend's
                                Postal</label>
                            <input refer-form-input="text" type="text" name="friend-home_zip"
                                id="form-refer-friend-home_zip" mrkto-field="#friendPostalCode"
                                class="js-smarty-zip" autocomplete="new-password" required />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label="required" for="form-refer-friend-home_country">Friend's
                                Country</label>
                            <input refer-form-input="text" type="text" name="friend-home_country"
                                id="form-refer-friend-country" mrkto-field="#friendCountry"
                                class="js-smarty-country" autocomplete="new-password" required />
                        </div>
                        <div refer-form-field="1/2">
                            <label refer-form-label for="form-refer-friend-phone">Friend's Phone</label>
                            <input refer-form-input="tel" type="tel" name="friend-phone"
                                id="form-refer-friend-phone" autocomplete="new-password"
                                mrkto-field="#friendPhone" />
                        </div>
                        <div refer-form-field="100% button">
                            <button refer-form-button id="form-refer-itinerary-required"
                                class="js-refer-button-required" test="refer-submit" type="submit">Refer
                                Friend</button>
                        </div>
                    </div>
                    <div refer-form-thankyou class="js-refer-thankyou hide">
                        <div refer-form-headline>
                            <div refer-form-thankyou-text="thankyou">
                                <strong enso>Thank you for the referral!</strong>
                                <p enso>We've received your friend's information.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<label for="modal-digital" class="hide" js-digital-location="URL"></label>
<input type="radio" modal-toggle name="modal-toggle" id="modal-digital" js="digital-toggle" />
<div modal="digital">
    <div digital-stage>
        <div digital-body>
            <!-- Close X  -->
            <label digital-form-close for="modal-reset" hide="sm" js-click-toggle></label>

            <!-- Header - Mobile Only -->
            <div digital-header hide="md+">
                <p digital-header-title enso>View Our {{ date('Y') . '/' . date('Y') + 1 }} Digital Catalog</p>
                <label digital-header-close for="modal-reset" js-click-toggle></label>
            </div>

            <!-- Aside - Desktop Only -->

            <div digital-aside hide="sm!">
                <div digital-aside-headlines enso>

                    <p digital-aside-headline="small">View Our {{ date('Y') . '/' . date('Y') + 1 }} </p>
                    <p digital-aside-headline="large">Digital Catalog</p>

                </div>
                <div digital-aside-content>
                    <div digital-aside-text enso>Help us save paper! We offer a digital version of The World's
                        Greatest Nature Journeys. If you'd prefer a mailed copy, please provide your contact details
                        <a href="/contact?lightbox=catalog/">here</a>. To view our digital catalog,
                        please enter your info in the form to the right.
                    </div>
                    <div digital-aside-logos>
                        <img digital-aside-logo="nathab" src="{{ $site_settings->site_logo }}"
                            alt="{{ $site_name }} Logo" />
                        <img digital-aside-logo="wwf" src="/uploaded-files/logos/logo-wwf.png" alt="WWF Logo" />
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div digital-form>
                <form id="form-digital" name="form-digital" action="{{ $submitRoute . '/view-digital-catalog' }}"
                    method="post">
                    @csrf
                    <div digital-form-required class="js-digital-required">
                        <div digital-form-headline hide="sm">
                            <div digital-form-headline-title enso>View Digital Catalog</div>
                        </div>

                        <div digital-form-field="1/2">
                            <label digital-form-label="required" for="form-digital-first_name">First
                                Name</label>
                            <input digital-form-input="text" type="text" js-format-name name="first_name"
                                id="form-digital-first_name" mrkto-field="#FirstName" required />
                        </div>

                        <div digital-form-field="1/2">
                            <label digital-form-label="required" for="form-digital-last_name">Last Name</label>
                            <input digital-form-input="text" type="text" js-format-name name="last_name"
                                id="form-digital-last_name" mrkto-field="#LastName" required />
                        </div>

                        <div digital-form-field="1/2">
                            <label digital-form-label="required" for="email">Email</label>
                            <input digital-form-input="email" type="email" name="email"
                                id="form-digital-email" mrkto-field="#Email" required />
                        </div>
                        <div digital-form-field="1/2">
                            <label digital-form-label for="form-digital-phone">Phone</label>
                            <input digital-form-input="tel" type="tel" js-format-phone
                                placeholder="(123) 456-7890" name="phone" id="form-digital-phone"
                                mrkto-field="#Phone" js-digital-phone-toggle />
                        </div>
                        <div digital-form-field="100%">
                            <label digital-form-label for="form-digital-trip-budget">What is your per-person
                                budget?</label>
                            <select digital-form-input="select" data-placeholder="Please Select"
                                id="form-digital-trip-budget" mrkto-field="#temp11CatBudget" name="trip-budget">
                                <option value="" selected>Please Select</option>
                                <option value="$0-$2500">$0-$2500</option>
                                <option value="$2500-$3500">$2500-$3500</option>
                                <option value="$3500-$5000">$3500-$5000</option>
                                <option value="$5000-$7500">$5000-$7500</option>
                                <option value="$7500-$10000">$7500-$10000</option>
                                <option value="$10000 or over">$10000 or over</option>
                            </select>
                        </div>
                        <div digital-form-field="100%">
                            <label digital-form-label for="form-digital-destinations-of-interest">Which
                                destinations interests you most? <span class="block-on-mobile smaller">(Select up
                                    to three)</span></label>
                            <fieldset digital-form-field-list="checkbox 2-column" js-limit="3">
                                @foreach ($regions as $item)
                                    <div digital-form-field="checkbox">
                                        <input digital-form-input="checkbox"
                                            id="form-digital-destination-{{ $item->permalink }}"
                                            name="destination-{{ $item->permalink }}" type="checkbox"
                                            mrkto-checkbox="#interestin{{ Str::ucfirst($item->permalink) }}"
                                            value="true" />
                                        <label digital-form-label="checkbox"
                                            for="form-digital-destination-{{ $item->permalink }}">African
                                            Safaris</label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                        <div digital-form-field="100%">
                            <label digital-form-label for="form-digital-destinations-of-interest">What type of
                                travel interests you most? <span class="block-on-mobile smaller">(Select up to
                                    two)</span></label>
                            <fieldset digital-form-field-list="checkbox 2-column" js-limit="2">
                                @foreach ($interests as $item)
                                    <div digital-form-field="checkbox">
                                        <input digital-form-input="checkbox"
                                            id="form-digital-interest-{{ $item->permalink }}"
                                            name="interest-{{ $item->permalink }}"
                                            mrkto-checkbox="#interestin{{ Str::ucfirst($item->permalink) }}"
                                            type="checkbox" value="true" />
                                        <label digital-form-label="checkbox"
                                            for="form-digital-interest-hiking-kayaking">Active hiking & kayaking
                                            adventures</label>
                                    </div>
                                @endforeach
                            </fieldset>
                        </div>
                        <div divider></div>
                        <div digital-form-field="100% checkbox">
                            <input digital-form-input="checkbox" type="checkbox"
                                name="form-digital-requestNewsletter" id="form-digital-requestNewsletter"
                                class="js-set-by-country" />
                            <label digital-form-label="checkbox optin divider" for="form-digital-requestNewsletter"
                                enso>
                                <span>Sign up to receive our travel emails!</span>
                                <a digital-form-privacy href="{{ $privacyPolicy }}" target="_blank">Privacy
                                    Policy</a>
                            </label>
                        </div>
                        <div digital-form-field="100% sms checkbox" class="hide js-sms-checkbox-digital">
                            <input digital-form-input="sms checkbox" type="checkbox" name="form-digital-Optin-SMS"
                                id="form-digital-Optin-SMS" js-digital-sms />
                            <label digital-form-label="checkbox optin" for="form-digital-Optin-SMS" enso>
                                <span>
                                    Sign up to receive promotional and informational text messages about our trips
                                </span>
                            </label>
                            <div digital-sms-privacy-wrapper enso>
                                <a digital-form-privacy href="#privacy-policy/promotional-sms#" target="_blank">Text
                                    Messaging Policy</a>
                                <span digital-sms-fine-print js-show-for-admin="inline">Message and data rates may
                                    apply. You can unsubscribe from SMS at any time by texting STOP. Reply HELP for
                                    help. 2-4 promotional msgs/month. Informational msg frequency varies.</span>
                            </div>
                        </div>
                        <div digital-form-field="100% button">
                            <button digital-form-button id="form-digital-itinerary-required"
                                class="js-digital-button-required" test="digital-submit" type="submit">View
                                Digital Catalog</button>
                        </div>
                    </div>
                    <div digital-form-thankyou class="js-digital-thankyou hide">
                        <div digital-form-headline>
                            <div digital-form-thankyou-text="thankyou">
                                <strong enso>Happy browsing!</strong>
                                <p enso>Thanks for requesting access to our digital catalog. <a href="#"
                                        target="_blank">Click here to view it now.</a> You&rsquo;ll also receive
                                    it by email momentarily.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="radio" modal-toggle name="modal-toggle" id="modal-trips" js="trip-toggle" />
<div modal="trips">
    <!-- Start Guts -->
    <div our-trips-stage>
        <div our-trips-header>
            <p our-trips-header-title>Our Trips</p>
            <label our-trips-close for="modal-reset" js-click-toggle></label>
        </div>
        <div our-trips-repeater enso>
            @foreach ($regions as $item)
                <a our-trips-trip href="{{ route('region', $item->permalink) }}">
                    <img our-trips-img ignore-cdn loading="lazy" src="{{ $item->medias()['pic'] }}"
                        alt="{{ $item->title }}" />
                    <p our-trips-title>
                        {{ $item->title }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
    <!-- End Guts -->
</div>

<input type="radio" class="hide-off-canvas" modal-toggle name="modal-toggle" id="modal-more"
    js="more-toggle" />
<div modal="more">
    <div more-stage>
        <div more-header>
            <p more-title>Questions?<a href="tel:{{ $site_settings->phone }}"> Call {{ $site_settings->phone }}</a>
            </p>
            <label more-close for="modal-reset" js-click-toggle></label>
        </div>
        <div more-body>
            <nav more-nav="nav">
                <ul more-nav="list">
                    <li more-nav="item home" class=""><a href="index.html" more-nav="link">Home</a>
                    </li>
                    <li more-nav="item trips" class=""><label hide="md+!" for="modal-trips"
                            js-click-toggle="trips" more-nav="link">Trip Finder</label></li>
                    <li more-nav="item login"><a href="{{ route('enter-portal') }}" more-nav="link">My
                            Portal</a></li>
                    <li more-nav="item conservation"><a href="/carbon-neutral-travel" hide="md+!"
                            more-nav="link">Carbon-Neutral Travel</a></li>
                    <li more-nav="item story"><a href="/quality-value-guarantee" more-nav="link">Quality & Value
                            Guarantee</a>
                    </li>
                    <li more-nav="item contact"><a href="/contact" more-nav="link">Contact</a></li>
                    <li more-nav="item awards"><a href="awards-mdeia-press" more-nav="link">Awards, Media &
                            Press</a></li>
                </ul>
            </nav>
            <div more-nav-footer>
                <label more-nav-footer-enews utility="button-cta-primary rounded gradient-reverse" for="modal-enews"
                    js-enews-location="Masthead"></label>
                <label more-nav-footer-catalog utility="button-cta-primary rounded gradient-reverse"
                    for="modal-catalog" js-catalog-location="Masthead" js-click-toggle="catalog"></label>
                <div more-nav-footer-social>
                    @foreach ($social_links as $item)
                        <a more-nav-social="link" js-social-link-footer="{{ $item->name }}"
                            href="{{ $item->url }}" target="_blank">
                            {!! $item->icon !!}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<input type="radio" modal-toggle name="modal-toggle" id="modal-contact" js="contact-toggle" />
<div modal="contact">
    <div contact-stage>
        <div contact-header>
            <div contact-title>Contact Us</div>
            <label contact-close for="modal-reset" js-click-toggle js-close-chat></label>
        </div>
        <div contact-body>
            <div contact-text enso>
                <p><strong>Have a question or comment? </strong><br />
                    Click any of the buttons below to get in touch with us.<br />
                    <br />
                    {{ $site_settings->availability }}
                </p>
            </div>
            <br>
            <div contact-buttons>
                <a contact-button="call" href="tel:{{ $site_settings->phone }}">Call
                    {{ $site_settings->phone }}</a>
                <label contact-button="message" js-message-location="Info Request Bottom" for="modal-message">Send
                    a Message</label>
            </div>
        </div>
    </div>
</div>

<!-- Youtube Modal -->
<dialog youtube-modal js="youtube-modal" hidden>
    <button youtube-modal-close js="youtube-modal-close">×</button>
    <iframe youtube-modal-iframe js="youtube-iframe" src="#" frameborder="0" allowfullscreen
        modestbranding></iframe>
</dialog>


<!-- For carbon modal -->
<div class="js-carbon-modal"></div>

<!-- Global modal overlay -->
<label modal-overlay name="modal-toggle" for="modal-reset" js-click-toggle></label>

<!-- Global modal reset -->
<input type="radio" modal-toggle="js-mobile-nav-active" name="modal-toggle" id="modal-reset" checked />
