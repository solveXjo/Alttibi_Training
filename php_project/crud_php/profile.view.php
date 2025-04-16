<head>
    <?php include 'partials/head.php'; ?>
    <title><?= htmlspecialchars($user['name'] ?? 'User') ?> | Profile</title>
    <style>
        .profile-header {
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .cover-photo {
            height: 200px;
            position: relative;
        }

        .profile-info {
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--card-color);
            object-fit: cover;
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--card-color);
        }

        .profile-name {
            margin-top: 70px;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-bio {
            color: var(--text-secondary);
            margin-bottom: 15px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 15px 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-weight: 600;
            font-size: 18px;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 14px;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr 2fr;
            }
        }

        .profile-card {
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-card h3 {
            margin-top: 0;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 15px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 15px;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-danger {
            background-color: #e41e3f;
            color: white;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #e7f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-danger {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .image-upload-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <?php require 'partials/nav.php'; ?>
    <?php include "Partials/pageTitle.php"; ?>


    <div class="container">
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <div class="profile-content">
            <div class="profile-card">
                <h3>About</h3>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?= htmlspecialchars($user['title'] ?? '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age"
                            value="<?= htmlspecialchars($user['age'] ?? '') ?>" required min="1" max="120">
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="bio" class="form-label">Bio</label>
                        <input type="text" class="form-control" id="bio" name="bio"
                            value="<?= htmlspecialchars($user['bio'] ?? '') ?>" required>
                    </div>



                    <div class="form-group">
                        <label for="country">Country</label>

                        <select id="location" name="location" class="form-control">
                            <option value="" disabled selected>Select a country</option>
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Åland Islands">Åland Islands</option>
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
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
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
                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
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
                            <option value="Guinea-bissau">Guinea-bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
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
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                            <option value="Korea, Republic of">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
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
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
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
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
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
                            <option value="Palestine">Palestine</option>
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
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syria</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan ">Tajikistan</option>
                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-leste">Timor-leste</option>
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
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select value="<?= htmlspecialchars($user['location'] ?? '') ?>">
                    </div>


                    <button type="submit" class="btn btn-primary" style="width: 100%;">Update Profile</button>
                </form>
            </div>

            <div>
                <!-- password -->
                <div class="profile-card" style="margin-bottom: 20px;">
                    <h3>Change Password</h3>
                    <form method="post" action="">

                        <div class="form-group">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <button type="submit" name="change_password" class="btn btn-primary" style="width: 100%;">
                            Update Password
                        </button>
                    </form>
                </div>

                <div class="profile-card">
                    <h3>Danger Zone</h3>
                    <form method="post" action="">
                        <input type="hidden" name="delete_account" value="1">
                        <button type="submit" class="btn btn-danger" style="width: 100%;"
                            onclick="return confirm('Are you sure you want to delete your account?')">
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <main class="main">



        <!-- Author Profile Section -->
        <section id="author-profile" class="author-profile section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="author-profile-1">

                    <div class="row">
                        <!-- Author Info -->
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="author-card" data-aos="fade-up">
                                <div class="author-image">
                                    <form method="post" enctype="multipart/form-data" class="image-upload-form">
                                        <label for="image" class="btn" style="margin-top: 70px;">
                                            <img src="uploads/<?= !empty($user['image_path']) ? htmlspecialchars($user['image_path']) : 'default.png' ?>" />
                                        </label>
                                        <input type="file" id="image" name="image" accept="image/*" style="display: none;"
                                            onchange="this.form.submit()">
                                    </form>

                                </div>





                                <div class="author-info">
                                    <h2><?= htmlspecialchars($user['name'] ?? 'User') ?></h2>

                                    <p class="designation"><?= htmlspecialchars($user['title'] ?? 'User') ?></p>



                                    <div class="author-stats d-flex justify-content-between text-center my-4">
                                        <div class="stat-item">
                                            <h4 data-purecounter-start="0" data-purecounter-end="147" data-purecounter-duration="1" class="purecounter">147</h4>
                                            <p>Articles</p>
                                        </div>
                                        <div class="stat-item">
                                            <h4 data-purecounter-start="0" data-purecounter-end="13" data-purecounter-duration="1" class="purecounter">13</h4>
                                            <p>Awards</p>
                                        </div>
                                        <div class="stat-item">
                                            <h4 data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="purecounter">25K</h4>
                                            <p>Followers</p>
                                        </div>
                                    </div>

                                    <div class="social-links">
                                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                    <div class="profile-location mt-4">
                                        <i class="fa fa-map-marker" style="color: #2d465e;"></i> <?= htmlspecialchars($user['location']) ?>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <!-- Author Content -->
                        <div class="col-lg-8">
                            <div class="author-content" data-aos="fade-up" data-aos-delay="200">
                                <div class="content-header">
                                    <h3>About Me</h3>
                                </div>
                                <div class="content-body">
                                    <p> <?= htmlspecialchars($user['bio'] ?? '') ?></p>

                                    <div class="expertise-areas">
                                        <h4>Areas of Expertise</h4>
                                        <div class="tags">
                                            <span>Artificial Intelligence</span>
                                            <span>Cybersecurity</span>
                                            <span>Smart Home Technology</span>
                                            <span>Digital Privacy</span>
                                            <span>Consumer Electronics</span>
                                            <span>Future Tech Trends</span>
                                        </div>
                                    </div>

                                    <div class="featured-articles mt-5">
                                        <h4>Featured Articles</h4>
                                        <div class="row g-4">
                                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                                <article class="article-card">
                                                    <div class="article-img">
                                                        <img src="assets/img/blog/blog-post-10.webp" alt="Article" class="img-fluid">
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="post-category">Technology</div>
                                                        <h5><a href="#">The Future of AI in Everyday Computing</a></h5>
                                                        <div class="post-meta">
                                                            <span><i class="fa fa-clock"></i> Jan 15, 2024</span>
                                                            <span><i class="fa fa-comments"></i> 24 Comments</span>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>

                                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                                <article class="article-card">
                                                    <div class="article-img">
                                                        <img src="assets/img/blog/blog-post-6.webp" alt="Article" class="img-fluid">
                                                    </div>
                                                    <div class="article-details">
                                                        <div class="post-category">Privacy</div>
                                                        <h5><a href="#">Understanding Digital Privacy in 2024</a></h5>
                                                        <div class="post-meta">
                                                            <span><i class="fa fa-clock"></i> Feb 3, 2024</span>
                                                            <span><i class="fa fa-comments"></i> 18 Comments</span>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Author Profile Section -->

    </main>

    <?php require 'Partials/footer.php'; ?>

</body>

</html>