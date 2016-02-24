
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Violate Responsive Admin Template">
        <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

        <title>Supply & Monitoring System</title>
            
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/animate.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/form.css" rel="stylesheet">
        <link href="css/calendar.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/icons.css" rel="stylesheet">
        <link href="css/generics.css" rel="stylesheet"> 
                <style type="text/css">

            #filedrag
            {
            display: none;
            font-weight: bold;
            text-align: center;
            padding: 1em 0;
            margin: 1em 0;
            color: #555;
            border: 2px dashed #555;
            border-radius: 7px;
            cursor: default;
            }

            #filedrag.hover
            {
            color: #f00;
            border-color: #f00;
            border-style: solid;
            box-shadow: inset 0 3px 4px #888;
            }

            img
            {
            max-width: 100%;
            }

            pre
            {
            width: 95%;
            height: 8em;
            font-family: monospace;
            font-size: 0.9em;
            padding: 1px 2px;
            margin: 0 0 1em auto;
            border: 1px inset #666;
            background-color: #eee;
            overflow: auto;
            }

            #messages
            {
            padding: 0 10px;
            margin: 1em 0;
            }

            #progress p
            {
            display: block;
            width: 240px;
            padding: 2px 5px;
            margin: 2px 0;
            border: 1px inset #446;
            border-radius: 5px;
            background: #eee url("css/progress.png") 100% 0 repeat-y;
            }

            #progress p.success
            {
            background: #0c0 none 0 0 no-repeat;
            }

            #progress p.failed
            {
            background: #c00 none 0 0 no-repeat;
            }
            #main .login-control {
    width: 100%;
    border: 0;
    padding: 7px 10px;
    background: rgba(0,0,0,0.35);
    border-radius: 2px 0px 0px 2px !important;
}
            </style>
    </head>
    <body id="skin-blur-lights">

        <header id="header" class="media">
            <a href="" id="menu-toggle"></a> 
            <a class="logo pull-left user-role" href=""></a>
            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            <?php include_once "navigation.php";?>            
            <!-- Content -->
            <section id="content" class="container">
                
                <h4 class="page-title block-title">Add New Applicant</h4>
                <hr class="whiter" />

                <hr class="whiter" />
                <div class="row">
                    <div class="columns col-lg-1 col-md-1"></div>
                    <div class="columns col-lg-10 col-md-10">
                        <!-- content here -->
                        <div class="row">
                <div class="columns col-lg-1 col-md-1 col-sm-1"></div>
                <div class="columns col-lg-10 col-md-10 col-sm-10">
                        <header>
                            <h3 class="block-title">Application Form</h3>
                            <br>
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p> -->
                        </header>
                        <form id="upload"  class="" action="upload.php" method="POST" enctype="multipart/form-data">
                            <fieldset>
                                <input type="hidden" id="MAX_FILE_SIZE" />
                                <div>
                                    <label for="fileselect">Upload a photo:</label>
                                    <input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
                                    <div id="filedrag">or drop files here</div>
                                </div>
                                <div id="submitbutton">
                                    <button type="submit">Upload Files</button>
                                </div>
                            </fieldset>
                        </form>
                        <div id="messages">
                        </div>
                        <form  id="frmUpdate" class="form-horizontal">
                             <input type="text" name="username" class="login-control m-b-10" placeholder="Username">
                            <input type="email" name="email" class="login-control m-b-10" placeholder="Email Address">    
                            <input type="password" name="password" class="login-control m-b-10" placeholder="Password">
                            <input type="password" name="password2" class="login-control m-b-20" placeholder="Confirm Password">
                            <input name="type" type="hidden" value="applicant"/>
                            <br>

                            <input type="hidden" name="photo" id="photo" class="form-control" placeholder="photo..."/>
                            <input type="hidden" name="addApplication" value="true"/>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="membership_type">Type of Membership</label>
                              <div class="col-sm-10">
                                <select class="select" id="membership_type" name="membership_type">
                                    <option value="Single">Single</option>
                                    <option value="Joint">Joint</option>
                                    <option value="Juridical">Juridical</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="consumer_type">Type of Consumer</label>
                              <div class="col-sm-10">
                                <select class="select" name="consumer_type" id="consumer_type">
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">Industrial</option>
                                    <option value="Public Building">Public Building</option>
                                    <option value="Water System">Water System</option>
                                    <option value="Special Light">Special Light</option>
                                </select>
                              </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="firstname">Firstname</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" id="firstname" value="" name="firstname" placeholder="firstname...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="lastname">Lastname</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" id="lastname" value=""  name="lastname" placeholder="lastname...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="middlename">Middlename</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" id="middlename" value="" name="middlename" placeholder="middlename...">
                              </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="address">Address</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="address" name="address" placeholder="address...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="nationality">Nationality</label>
                              <div class="col-sm-10">
                                <select name="nationality" class="select" id="nationality">
                                    <option value="afghan">Afghan</option>
                                    <option value="albanian">Albanian</option>
                                    <option value="algerian">Algerian</option>
                                    <option value="american">American</option>
                                    <option value="andorran">Andorran</option>
                                    <option value="angolan">Angolan</option>
                                    <option value="antiguans">Antiguans</option>
                                    <option value="argentinean">Argentinean</option>
                                    <option value="armenian">Armenian</option>
                                    <option value="australian">Australian</option>
                                    <option value="austrian">Austrian</option>
                                    <option value="azerbaijani">Azerbaijani</option>
                                    <option value="bahamian">Bahamian</option>
                                    <option value="bahraini">Bahraini</option>
                                    <option value="bangladeshi">Bangladeshi</option>
                                    <option value="barbadian">Barbadian</option>
                                    <option value="barbudans">Barbudans</option>
                                    <option value="batswana">Batswana</option>
                                    <option value="belarusian">Belarusian</option>
                                    <option value="belgian">Belgian</option>
                                    <option value="belizean">Belizean</option>
                                    <option value="beninese">Beninese</option>
                                    <option value="bhutanese">Bhutanese</option>
                                    <option value="bolivian">Bolivian</option>
                                    <option value="bosnian">Bosnian</option>
                                    <option value="brazilian">Brazilian</option>
                                    <option value="british">British</option>
                                    <option value="bruneian">Bruneian</option>
                                    <option value="bulgarian">Bulgarian</option>
                                    <option value="burkinabe">Burkinabe</option>
                                    <option value="burmese">Burmese</option>
                                    <option value="burundian">Burundian</option>
                                    <option value="cambodian">Cambodian</option>
                                    <option value="cameroonian">Cameroonian</option>
                                    <option value="canadian">Canadian</option>
                                    <option value="cape verdean">Cape Verdean</option>
                                    <option value="central african">Central African</option>
                                    <option value="chadian">Chadian</option>
                                    <option value="chilean">Chilean</option>
                                    <option value="chinese">Chinese</option>
                                    <option value="colombian">Colombian</option>
                                    <option value="comoran">Comoran</option>
                                    <option value="congolese">Congolese</option>
                                    <option value="costa rican">Costa Rican</option>
                                    <option value="croatian">Croatian</option>
                                    <option value="cuban">Cuban</option>
                                    <option value="cypriot">Cypriot</option>
                                    <option value="czech">Czech</option>
                                    <option value="danish">Danish</option>
                                    <option value="djibouti">Djibouti</option>
                                    <option value="dominican">Dominican</option>
                                    <option value="dutch">Dutch</option>
                                    <option value="east timorese">East Timorese</option>
                                    <option value="ecuadorean">Ecuadorean</option>
                                    <option value="egyptian">Egyptian</option>
                                    <option value="emirian">Emirian</option>
                                    <option value="equatorial guinean">Equatorial Guinean</option>
                                    <option value="eritrean">Eritrean</option>
                                    <option value="estonian">Estonian</option>
                                    <option value="ethiopian">Ethiopian</option>
                                    <option value="fijian">Fijian</option>
                                    <option value="filipino">Filipino</option>
                                    <option value="finnish">Finnish</option>
                                    <option value="french">French</option>
                                    <option value="gabonese">Gabonese</option>
                                    <option value="gambian">Gambian</option>
                                    <option value="georgian">Georgian</option>
                                    <option value="german">German</option>
                                    <option value="ghanaian">Ghanaian</option>
                                    <option value="greek">Greek</option>
                                    <option value="grenadian">Grenadian</option>
                                    <option value="guatemalan">Guatemalan</option>
                                    <option value="guinea-bissauan">Guinea-Bissauan</option>
                                    <option value="guinean">Guinean</option>
                                    <option value="guyanese">Guyanese</option>
                                    <option value="haitian">Haitian</option>
                                    <option value="herzegovinian">Herzegovinian</option>
                                    <option value="honduran">Honduran</option>
                                    <option value="hungarian">Hungarian</option>
                                    <option value="icelander">Icelander</option>
                                    <option value="indian">Indian</option>
                                    <option value="indonesian">Indonesian</option>
                                    <option value="iranian">Iranian</option>
                                    <option value="iraqi">Iraqi</option>
                                    <option value="irish">Irish</option>
                                    <option value="israeli">Israeli</option>
                                    <option value="italian">Italian</option>
                                    <option value="ivorian">Ivorian</option>
                                    <option value="jamaican">Jamaican</option>
                                    <option value="japanese">Japanese</option>
                                    <option value="jordanian">Jordanian</option>
                                    <option value="kazakhstani">Kazakhstani</option>
                                    <option value="kenyan">Kenyan</option>
                                    <option value="kittian and nevisian">Kittian and Nevisian</option>
                                    <option value="kuwaiti">Kuwaiti</option>
                                    <option value="kyrgyz">Kyrgyz</option>
                                    <option value="laotian">Laotian</option>
                                    <option value="latvian">Latvian</option>
                                    <option value="lebanese">Lebanese</option>
                                    <option value="liberian">Liberian</option>
                                    <option value="libyan">Libyan</option>
                                    <option value="liechtensteiner">Liechtensteiner</option>
                                    <option value="lithuanian">Lithuanian</option>
                                    <option value="luxembourger">Luxembourger</option>
                                    <option value="macedonian">Macedonian</option>
                                    <option value="malagasy">Malagasy</option>
                                    <option value="malawian">Malawian</option>
                                    <option value="malaysian">Malaysian</option>
                                    <option value="maldivan">Maldivan</option>
                                    <option value="malian">Malian</option>
                                    <option value="maltese">Maltese</option>
                                    <option value="marshallese">Marshallese</option>
                                    <option value="mauritanian">Mauritanian</option>
                                    <option value="mauritian">Mauritian</option>
                                    <option value="mexican">Mexican</option>
                                    <option value="micronesian">Micronesian</option>
                                    <option value="moldovan">Moldovan</option>
                                    <option value="monacan">Monacan</option>
                                    <option value="mongolian">Mongolian</option>
                                    <option value="moroccan">Moroccan</option>
                                    <option value="mosotho">Mosotho</option>
                                    <option value="motswana">Motswana</option>
                                    <option value="mozambican">Mozambican</option>
                                    <option value="namibian">Namibian</option>
                                    <option value="nauruan">Nauruan</option>
                                    <option value="nepalese">Nepalese</option>
                                    <option value="new zealander">New Zealander</option>
                                    <option value="ni-vanuatu">Ni-Vanuatu</option>
                                    <option value="nicaraguan">Nicaraguan</option>
                                    <option value="nigerien">Nigerien</option>
                                    <option value="north korean">North Korean</option>
                                    <option value="northern irish">Northern Irish</option>
                                    <option value="norwegian">Norwegian</option>
                                    <option value="omani">Omani</option>
                                    <option value="pakistani">Pakistani</option>
                                    <option value="palauan">Palauan</option>
                                    <option value="panamanian">Panamanian</option>
                                    <option value="papua new guinean">Papua New Guinean</option>
                                    <option value="paraguayan">Paraguayan</option>
                                    <option value="peruvian">Peruvian</option>
                                    <option value="polish">Polish</option>
                                    <option value="portuguese">Portuguese</option>
                                    <option value="qatari">Qatari</option>
                                    <option value="romanian">Romanian</option>
                                    <option value="russian">Russian</option>
                                    <option value="rwandan">Rwandan</option>
                                    <option value="saint lucian">Saint Lucian</option>
                                    <option value="salvadoran">Salvadoran</option>
                                    <option value="samoan">Samoan</option>
                                    <option value="san marinese">San Marinese</option>
                                    <option value="sao tomean">Sao Tomean</option>
                                    <option value="saudi">Saudi</option>
                                    <option value="scottish">Scottish</option>
                                    <option value="senegalese">Senegalese</option>
                                    <option value="serbian">Serbian</option>
                                    <option value="seychellois">Seychellois</option>
                                    <option value="sierra leonean">Sierra Leonean</option>
                                    <option value="singaporean">Singaporean</option>
                                    <option value="slovakian">Slovakian</option>
                                    <option value="slovenian">Slovenian</option>
                                    <option value="solomon islander">Solomon Islander</option>
                                    <option value="somali">Somali</option>
                                    <option value="south african">South African</option>
                                    <option value="south korean">South Korean</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="sri lankan">Sri Lankan</option>
                                    <option value="sudanese">Sudanese</option>
                                    <option value="surinamer">Surinamer</option>
                                    <option value="swazi">Swazi</option>
                                    <option value="swedish">Swedish</option>
                                    <option value="swiss">Swiss</option>
                                    <option value="syrian">Syrian</option>
                                    <option value="taiwanese">Taiwanese</option>
                                    <option value="tajik">Tajik</option>
                                    <option value="tanzanian">Tanzanian</option>
                                    <option value="thai">Thai</option>
                                    <option value="togolese">Togolese</option>
                                    <option value="tongan">Tongan</option>
                                    <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                    <option value="tunisian">Tunisian</option>
                                    <option value="turkish">Turkish</option>
                                    <option value="tuvaluan">Tuvaluan</option>
                                    <option value="ugandan">Ugandan</option>
                                    <option value="ukrainian">Ukrainian</option>
                                    <option value="uruguayan">Uruguayan</option>
                                    <option value="uzbekistani">Uzbekistani</option>
                                    <option value="venezuelan">Venezuelan</option>
                                    <option value="vietnamese">Vietnamese</option>
                                    <option value="welsh">Welsh</option>
                                    <option value="yemenite">Yemenite</option>
                                    <option value="zambian">Zambian</option>
                                    <option value="zimbabwean">Zimbabwean</option>
                                  </select>
                                <!-- <input class="form-control" type="text" value=""  id="nationality" name="nationality" placeholder="nationality..."> -->
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="civil_status">Civil Status</label>
                              <div class="col-sm-10">
                                <select class="select" name="civil_status" id="civil_status">
                                  <option value="Single">Single</option>
                                  <option value="Married">Married</option>
                                  <option value="Separated">Separated</option>
                                  <option value="Divorced">Divorced</option>
                                  <option value="Widowed">Widowed</option>
                                </select>
                                <!-- <input class="form-control" type="text" value=""  id="civil_status" name="civil_status" placeholder="civil status..."> -->
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="dob">Date of Birth</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="dob" name="dob" placeholder="Date of Birth...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="pob">Place of Birth</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="pob" name="pob" placeholder="Place of Birth...">
                              </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="age">Age</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" id="age" name="age" value=""  placeholder="age...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="gender">Gender</label>
                              <div class="col-sm-10">
                               Male <input type="radio" name="gender" id="male" checked value="male">
                               <br>
                               Female <input type="radio" name="gender"  id="female" value="female">
                              </div>
                            </div>
                    
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="religion">Religion</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="religion" name="religion" placeholder="religion...">
                              </div>
                            </div>

                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="weight">Weight</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="weight" name="weight" placeholder="weight...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="height">Height</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="height" name="height" placeholder="height...">
                              </div>
                            </div>
                            <span id="spouse" class="hidden">
                                <h5 class="block-title">Spouse</h5>

                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-lastname">Lastname</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-lastname" name="s-lastname" placeholder="lastname...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-firstname">Firstname</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-firstname" name="s-firstname" placeholder="firstname...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-middlename">Middlename</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-middlename" name="s-middlename" placeholder="middlename...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-dob">Date of Birth</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-dob" name="s-dob" placeholder="dob...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-pob">Place of Birth</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-pob" name="s-pob" placeholder="place of birth...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-age">Age</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-age" name="s-age" placeholder="age...">
                              </div>
                            </div>
                            <div class="form-group form-group-md">
                              <label class="col-sm-2 control-label" for="s-occupation">Occupation</label>
                              <div class="col-sm-10">
                                <input class="form-control" type="text" value=""  id="s-occupation" name="s-occupation" placeholder="occupation...">
                              </div>
                            </div>
                            </span>
                            
                            <div class="form-group form-group-md">
                              <input type="submit" value="Create" class="btn pull-right ">
                            </div>
                          
                          </form>
                       <div id="errors" class="my-errors hidden my-alert-parent">
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                  <button type="button" class="close my-alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                  <h4 id="oh-snap!-you-got-an-error!">Oh snap! You got an error!
                                    <a class="anchorjs-link" href="#oh-snap!-you-got-an-error!"><span class="anchorjs-icon"></span></a></h4>
                                  <div id="all-errors"></div>
                                    <button type="button" class="my-alert btn btn-danger"  class="btn btn-danger">Okay</button>
                                </div>
                            </div>
                        <div id="success" class="hidden my-alert-parent">
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                              <button type="button" class="close my-alert"  aria-label="Close"><span aria-hidden="true">×</span></button>
                              <strong>Succesfully Registered!</strong>.
                            </div>
                        </div>

                </div>
                <div class="columns col-lg-1 col-md-1 col-sm-1"></div>
            </div>
                    </div>
                    <div class="columns col-lg-1 col-md-1"></div>
                </div>
            </section>
        </section>
        <script type="text/html" id="slide">
            <div class="row add-slide">
                <div class="columns col-lg-12">
                    <img style="width: 200px; border: 2px dashed white; padding: 5px;" class="cover" src="uploads/[FILENAME]" />
                </div>
            </div>
        </script>
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
        <script src="js/jquery-ui.min.js"></script> <!-- jQuery UI -->
        <script src="js/jquery.easing.1.3.js"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>

       
        <!--  Form Related -->
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        <script src="js/select.min.js"></script>
        <!-- UX -->
        <script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

        <!-- Other -->
        <script src="js/calendar.min.js"></script> <!-- Calendar -->
        <script src="js/feeds.min.js"></script> <!-- News Feeds -->
        

        <!-- All JS functions -->
        <script src="js/functions.js"></script>
        <script type="text/javascript">
        (function($){
            var Dashboard = {
                __init : function(){
                    this.__listen();
                    this.loadUser();
                },
                __error : function(error, target){
                    var target = target.find("#all-errors");

                    $("#success").hide();

                    for(var i in error){
                        var p = $("<p>"+ error[i] +"</p>");
                        console.log(error[i]);
                        target.append(p);
                    }

                    $("#errors").removeClass("hidden").hide().fadeIn("slow");
                },
                loadUser : function(){
                    var me = this;

                    $.ajax({
                        url     : "backend/process.php",
                        data    : {loadSession: true},
                        type    : 'POST',
                        dataType : 'JSON',
                        success     : function(response){
                            console.log(response);
                            if(response.redirect != null){
                                window.location.href = response.redirect;
                            } else {
                                $(".current-user").html(response.username);
                                $(".user-role").html(response.type);
                            }
                            
                            // me.loadAnnouncement();
                        },
                        error       : function(){
                            console.log("err");
                        }
                    });
                },
                loadAnnouncement : function(){
                    $.ajax({
                        url     : "backend/process.php",
                        data        : { loadAnnouncement:true},
                        type        : 'POST',
                        dataType    : 'JSON',
                        success     : function(response){
                            var target = $(".timeline");
                            
                            target.html("");

                            for(var i in response){
                                var announcement = $("#announcement").html();

                                announcement = announcement.replace("[DATE]", response[i].dateadded).
                                    replace("[TITLE]", response[i].title).
                                    replace("[DESCRIPTION]", response[i].description);

                                target.append(announcement);
                            }

                            $(".add-announcement").modal("hide");
                        },
                        error       : function(){
                            console.log("error");
                        }
                    });
                },
                __listen : function(){
                    var me      = this;
                    var save    = $("#add-announcement");
                    var logout  = $(".logout");

                    var me      = this;
                    // $("#dob").datepicker();

                    $("#civil_status").on("change", function(){
                      var val = $(this).val();
                      if(val == "Married"){
                        $("#spouse").removeClass("hidden");
                      } else {
                        $("#spouse").addClass("hidden");
                      }
                    });

                    $("#frmUpdate").on("submit", function(e){
                        e.preventDefault();

                        $.ajax({
                          url : 'backend/process.php',
                          data  : $(this).serialize(),
                          type  : 'POST',
                          dataType :'JSON',
                          success: function(response){
                            console.log(response);
                            if(response.added != null){
                                alert("Record is succesfully Added.");

                                    // $("#success").removeClass("hidden").fadeIn("slow");
                            } else {
                                if(response.error.length > 0){
                                    me.__error(response.error, $("body"));
                                }    
                            }
                            
                            // $("#info").modal("show");
                          },
                          error   : function(){
                            console.log("Oops, something went wrong");
                          }
                        });

                      });

                    logout.on("click", function(e){
                        $.ajax({
                            url     : "backend/process.php",
                            data    : {logout:true},
                            type    : 'POST',
                            dataType    : 'JSON',
                            success     : function(response){
                                window.location.href = "index.html";
                            },
                            error       : function(){
                                console.log("err");
                            }
                        });

                        e.preventDefault();
                    });

                    save.on("click", function(e){
                        var title   = $("#title").val();
                        var desc    = $("#description").val();

                        $.ajax({
                            url     : "backend/process.php",
                            data    : {title: title, description:desc, announcement:true},
                            type    : 'POST',
                            dataType : 'JSON',
                            success     : function(response){
                                console.log(response);

                                // me.loadAnnouncement();
                            },
                            error   : function(){
                                console.log("err");
                            }
                        });

                        e.preventDefault(); 
                    }); 
                }   
              
            }

            Dashboard.__init();
             function $id(id) {
            return document.getElementById(id);
        }


        // output information
        function Output(msg) {
            var m = $id("messages");
            m.innerHTML = msg;
        }


        // file drag hover
        function FileDragHover(e) {
            e.stopPropagation();
            e.preventDefault();
            e.target.className = (e.type == "dragover" ? "hover" : "");
        }


        // file selection
        function FileSelectHandler(e) {

            // cancel event and hover styling
            FileDragHover(e);

            // fetch FileList object
            var files = e.target.files || e.dataTransfer.files;

            // process all File objects
            for (var i = 0, f; f = files[i]; i++) {
                ParseFile(f);
                // UploadFile(f);
            }

        }


        // output file information
        function ParseFile(file) {
            var found   = false;

            // display an image
            if (file.type.indexOf("image") == 0) {
                found = true;
            }

            if(found != true){
                console.log("Invalid File Format");
                console.log(file);
            } else {
                $("#photo").val(file.name);
                UploadFile(file);
            }
        }


        function UploadFile(file) {

            var xhr = new XMLHttpRequest();
            if (xhr.upload ) {

                // // create progress bar
                // var o = $id("progress");
                // var progress = o.appendChild(document.createElement("p"));
                // progress.appendChild(document.createTextNode("upload " + file.name));


                // // progress bar
                // xhr.upload.addEventListener("progress", function(e) {
                //     var pc = parseInt(100 - (e.loaded / e.total * 100));
                //     progress.style.backgroundPosition = pc + "% 0";
                // }, false);

                // file received/failed
                xhr.onreadystatechange = function(e) {
                    if (xhr.readyState == 4) {
                        var reader = new FileReader();
                        var slide   = $("#slide").html();

                        reader.onload = function(e) {
                            slide = slide.replace("[FILENAME]", file.name);
                            Output(slide);
                        }

                        reader.readAsDataURL(file);

                //         progress.className = (xhr.status == 200 ? "success" : "failure");
                    }
                };
                // start upload
                xhr.open("POST", $id("upload").action, true);
                xhr.setRequestHeader("X-FILENAME", file.name);
                xhr.send(file);

            }

        }


        // initialize
        function Init() {

            var fileselect = $id("fileselect"),
                filedrag = $id("filedrag"),
                submitbutton = $id("submitbutton");

            // file select
            fileselect.addEventListener("change", FileSelectHandler, false);
            // is XHR2 available?
            var xhr = new XMLHttpRequest();
            if (xhr.upload) {   
                // file drop
                filedrag.addEventListener("dragover", FileDragHover, false);
                filedrag.addEventListener("dragleave", FileDragHover, false);
                filedrag.addEventListener("drop", FileSelectHandler, false);
                filedrag.style.display = "block";

                // remove submit button
                submitbutton.style.display = "none";
            }

        }

        // call initialization file
        if (window.File && window.FileList && window.FileReader) {
            Init();
        }

        })(jQuery);
        </script>
    </body>
</html>
