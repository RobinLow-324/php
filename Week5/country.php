<!DOCTYPE html>
<html>
<body>

<h1>Fill In Your Simple Data</h1>

<p>Please fill out the form below:</p>

<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
  <label for="country">Choose a country: </label>
  <select name="country" id="country" required>
    <option value="">--Please Select Country--</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Canada">Canada</option>
    <option value="USA">UK</option>
    <option value="UK">Australia</option>
    <option value="Germany">Germany</option>
    <option value="France">France</option>
    <option value="India">India</option>
    <option value="Japan">Japan</option>
    <option value="China">China</option>
    <option value="Brazil">Brazil</option>
  </select>
  <br><br>

  <label for="day">Choose your Date of Birth: </label>
  <select name="day" id="day" required>
    <option value="">--Day--</option>
    <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
  </select>

  <select name="month" id="month" required>
    <option value="">--Month--</option>
    <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i'>$i</option>"; ?>
  </select>

  <select name="year" id="year" required>
    <option value="">--Year--</option>
    <?php for ($i = 2000; $i <= 2024; $i++) echo "<option value='$i'>$i</option>"; ?>
  </select>
  <br><br>

  <label for="gender">Gender: </label>
  <input type="radio" name="gender" value="Male" required> Male
  <input type="radio" name="gender" value="Female" required> Female
  <input type="radio" name="gender" value="Other" required> Other
  <br><br>

  <input type="submit" value="Submit">
  <br>

  <p>When you fill all the data please click the "Submit" button</p>
  <br><br>

  <?php
if(!empty($_GET))
{ 
     $country = $_GET["country"];
      $day = $_GET["day"];
      $month = $_GET["month"];
      $year = $_GET["year"];
      $gender = $_GET["gender"];
    
      echo "Your Country is: " . $country . "<br><br>"; 
      echo "Date of Birth: " . $day . " - " . $month . " - " . $year . "<br><br>";
      echo "Gender: " . $gender . "<br><br>";

    $birthDate = new DateTime("$year-$month-$day");
    $currentDate = new DateTime();
    $age = $birthDate->diff($currentDate)->y;
    echo "Your Age is: " . $age . " years old.<br><br>";
}
?>
</form>



</body>
</html>