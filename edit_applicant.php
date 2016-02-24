    <?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">Edit Applicant's information</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 blog-main">
          <!-- other content goes here -->
          <?php $user = $model->getUserById($_GET['id']); 
            $user = $user[0];
          ?>
          <?php
          // echo "<pre>";
          // print_r($user);
          ?>
        <form id="frmUpdate">
        <input type="hidden" name="updateUserDetail" value="true"/>
        <input type="hidden" name="userid" value="<?= $_GET['id']; ?>"/>
        <input type="hidden" name="photo" id="photo" class="form-control" placeholder="photo..."/>
        <div class="col-sm-12">
          <table class="table">
            <thead>
              <tr>
                <th><h3>Personal</h3></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>  <label class="label" for="firstname">Firstname</label> </td>
                <td>
                  <input class="form-control" type="text" id="firstname" value="<?= $user['firstname']; ?>" name="firstname" placeholder="firstname...">
                </td>
              </tr>
              <tr>
                <td> <label class="label" for="lastname">Lastname</label></td>
                <td>  <input class="form-control" type="text" id="lastname" value="<?= $user['lastname']; ?>"  name="lastname" placeholder="lastname..."></td>
              </tr>
              <tr>
                <td><label class="label" for="middlename">Middlename</label></td>
                <td><input class="form-control" type="text" id="middlename" value="<?= $user['middlename']; ?>" name="middlename" placeholder="middlename..."></td>
              </tr>
              <tr>
                <td><label class="label" for="contact_number">Contact Number</label></td>
                <td><input class="form-control" type="text" id="contact_number" value="<?= $user['contact_number']; ?>" name="contact_number" placeholder="contact number..."></td>
              </tr>
              <tr>
                <td colspan="2">
                  <hr>
                </td>
              </tr>
              <tr>
                <td><label class="label" for="address">Address</label></td>
                <td><input class="form-control" type="text" value="<?= $user['address']; ?>"  id="address" name="address" placeholder="address..."></td>
              </tr>
              <tr>
                <td><label class="label" for="nationality">Nationality</label></td>
                <td>
                  <select name="nationality" class="form-control" id="nationality">
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
                </td>
              </tr>
              <tr>
                <td> <label class="label" for="civil_status">Civil Status</label></td>
                <td><select class="form-control" name="civil_status" id="civil_status">
                    <option value="Single"<?= ($user['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?= ($user['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                    <option value="Separated" <?= ($user['civil_status'] == 'Separated') ? 'selected' : ''; ?>>Separated</option>
                    <option value="Divorced" <?= ($user['civil_status'] == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Widowed" <?= ($user['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                  </select></td>
              </tr>
              <tr>
                <td><label class="label" for="dob">Date of Birth</label></td>
                <td><input class="form-control" type="text" value="<?= $user['dob']; ?>"  id="dob" name="dob" placeholder="Date of Birth..."></td>
              </tr>
              <tr>
                <td><label class="label" for="pob">Place of Birth</label></td>
                <td> <input class="form-control" type="text" value="<?= $user['pob']; ?>"  id="pob" name="pob" placeholder="Place of Birth..."></td>
              </tr>
              <tr>
                <td><label class="label" for="age">Age</label></td>
                <td><input class="form-control" type="text" id="age" readonly name="age" value="<?= $user['age']; ?>"  placeholder="age..."></td>
              </tr>
              <tr>
                <td><label class="label" for="gender">Gender</label></td>
                <td>
                  <div class="radio-inline">
                    <label class="gender"> <input type="radio" name="gender" id="male" <?= ($user['sex'] == 'male') ? 'checked' : ''; ?> value="male">Male</label>
                  </div>
                  <div class="radio-inline">
                    <label class="gender">
                        <input type="radio" name="gender"  id="female" <?= ($user['sex'] == 'female') ? 'checked' : ''; ?> value="female">Female
                    </label>
                  </div>
                </td>
              </tr>
              <tr class="hidden">
                <td>
                  <label class="label" for="religion">Religion</label>
                </td>
                <td>
                  <input class="form-control" type="text" value="<?= $user['religion']; ?>"  id="religion" name="religion" placeholder="religion...">
                </td>
              </tr>
              <tr class="hidden">
                <td><label class="label" for="weight">Weight</label></td>
                <td><input class="form-control" type="text" value=""  id="weight" name="weight" placeholder="weight..."></td>
              </tr>
              <tr class="hidden">
                <td><label class="label" for="height">Height</label></td>
                <td><input class="form-control" type="text" value=""  id="height" name="height" placeholder="height..."></td>
              </tr>
            </tbody>
          </table>
          <table class="table hidden" id="spouse">
            <thead>
              <tr>
                <th><h3>Spouse</h3></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label class="label" for="s-lastname">Lastname</label></td>
                <td><input class="form-control" type="text" value=""  id="s-lastname" name="s-lastname" placeholder="lastname..."></td>
              </tr>
              <tr>
                <td> <label class="label" for="s-firstname">Firstname</label></td>
                <td>
                  <input class="form-control" type="text" value=""  id="s-firstname" name="s-firstname" placeholder="firstname...">
                </td>
              </tr>
              <tr>
                <td><label class="label" for="s-middlename">Middlename</label></td>
                <td><input class="form-control" type="text" value=""  id="s-middlename" name="s-middlename" placeholder="middlename..."></td>
              </tr>
              <tr>
                <td><label class="label" for="s-dob">Date of Birth</label></td>
                <td><input class="form-control" type="text" value=""  id="s-dob" name="s-dob" placeholder="dob..."></td>
              </tr>
              <tr>
                <td>  <label class="label" for="s-pob">Place of Birth</label></td>
                <td> <input class="form-control" type="text" value=""  id="s-pob" name="s-pob" placeholder="place of birth..."></td>
              </tr>
              <tr>
                <td><label class="label" for="s-age">Age</label></td>
                <td><input class="form-control" type="text" value=""  id="s-age" name="s-age" placeholder="age..."></td>
              </tr>
              <tr>
                <td><label class="label" for="s-occupation">Occupation</label></td>
                <td><input class="form-control" type="text" value=""  id="s-occupation" name="s-occupation" placeholder="occupation..."></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-5">
          <!-- other information -->
          <table class="table hidden">
            <thead>
              <tr>
                <th>
                  <h3>Membership Info</h3>
                </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label class="label" for="membership_type">Type of Membership</label></td>
                <td>
                  <select class="form-control" id="membership_type" name="membership_type">
                      <option value="Single">Single</option>
                      <option value="Joint">Joint</option>
                      <option value="Juridical">Juridical</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label class="label" for="consumer_type">Type of Consumer</label></td>
                <td><select class="select form-control" name="consumer_type" id="consumer_type">
                      <option value="Residential">Residential</option>
                      <option value="Commercial">Commercial</option>
                      <option value="Industrial">Industrial</option>
                      <option value="Public Building">Public Building</option>
                      <option value="Water System">Water System</option>
                      <option value="Special Light">Special Light</option>
                  </select></td>
              </tr>
            </tbody>
          </table>
          <?php
          $children = $model->getChildrenById($user['id']);
          ?>
          <table class="table hidden" id="children">
            <thead>
              <tr>
                <th>
                  <h3>Children</h3>
                </th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label>Name</label></td>
                <td><label>Date of Birth</label></td>
                <td></td>
              </tr>
              <?php foreach($children as $idx => $c): ?>
              <tr>
                <td><input type="text" name="c-name[]" class="children-name form-control" value="<?= $c['name'];?>" placeholder="Name"/></td>
                <td><input type="text" name="c-dob[]" class="children-dob form-control" value="<?= $c['dob'];?>" placeholder="Birthdate"/></td>
                <td>
                  <button class="btn"><span class="glyphicon glyphicon-remove"></span></button>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">
                  <button class="add-children btn">
                    <span class="glyphicon glyphicon-plus glyphicon "></span>
                  </button>
                </td>
              </tr>
            </tfoot>
          </table>
          <tr>
            <td>
              <input type="submit" class="btn btn-success" value="Update"/>
              <br>
              <br>
            </td>
          </tr>
        </div>
        </form>

          <br>
          <br>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->
        <div class="col-sm-1"></div>
      </div><!-- /.row -->

    </div><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/jquery-ui.min.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
      var Page = {
        __init : function(){
          this.__listen();
        },
        __error : function(error){
            $("#errors").html("");
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        __listen : function(){
          var me      = this;
          var addChildren = $(".add-children");

          addChildren.on("click", function(e){
            var target = $("#children tbody");
            var tpl = $("#tpl").html();

            target.append(tpl);
            e.preventDefault();
          });

          $("#dob").datepicker();
          $("#dob").on("change", function(){
            var date = $(this).val();
            var dob = new Date(date);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

            $("#age").val(age);
          });
          // $("#civil_status").on("change", function(){
          //   var val = $(this).val();
          //   if(val != "Single"){
          //     $("#spouse").removeClass("hidden");
          //   } else {
          //     $("#spouse").addClass("hidden");
          //   }
          // });

          $("#frmUpdate").on("submit", function(e){
            e.preventDefault();
            $.ajax({
              url : 'backend/process.php',
              data  : $(this).serialize(),
              type  : 'POST',
              dataType :'JSON',
              success: function(response){
                $("#errors").html("");
                if(response.status != null){
                    alert("Record is succesfully Updated.");

                        // $("#success").removeClass("hidden").fadeIn("slow");
                } else {
                    if(response.error.length > 0){
                        me.__error(response.error);
                    }    
                }
                
                // $("#info").modal("show");
              },
              error   : function(){
                console.log("Oops, something went wrong");
              }
            });

          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
