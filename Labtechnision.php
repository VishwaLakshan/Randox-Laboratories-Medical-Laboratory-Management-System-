<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/assistantLabTech_Dashboard_style.css">

</head>
<body>


<header>
    <a href="#" class="brand"> <img src="assets/images/logo/logo.png" alt="Logo" width="250px" height="70px"></a>

    <div class="menu-btn">

    </div>
    <div class="navigation">
        <div class="navigation-items">

            <a href="#" class="nav-link"><b>Home</b></a>

            <a href="#"><button><b>Login</button></b></a>
        </div>
    </div>
</header><br><br><br>
<style>
    /* Hover effect for navigation links */
    .navbar-nav .nav-link:hover {
        background-color: #ffa500;
    }
</style>

<div class="container mt-5 custom-bg-color">
    <div class="row">
        <!-- Left Section - Select Test Type -->
        <div class="col-md-4">
            <div class="form-section">
                <h2>Select Test Type</h2>
                <button class="btn btn-primary" onclick="showUrineTestForm()">Urine Test</button>
                <button class="btn btn-primary" onclick="showFullBloodTestForm()">Full Blood Test</button>
                <button class="btn btn-primary" onclick="showLipidTestForm()">Lipid Test</button>
            </div>
        </div>

        <!-- Right Section - Display and Submit Forms -->
        <div class="col-md-8">
            <div class="form-section" id="formSection">

            </div>
        </div>
    </div>
</div>

<form class="d-flex justify-content-end" role="search">

    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="max-width: 200px;">
    <button class="btn btn-outline-success" type="submit">Search</button>

</form>

<div class="form_contents">

    <!-- Urine Test Form Template -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-box">
                    <div id="urineTestForm" class="form-template" style="align-items: center;">
                        <h2>Urine Test</h2>
                        <!-- <form action="save.php" method="POST"> -->
                        <input type="text" name="name" placeholder=" Name" class="form-control" required><br>
                        <input type="text" name="RB" placeholder="Red Blood Count" class="form-control" required><br>
                        <input type="text" name="protein" placeholder="Protein" class="form-control"><br>
                        <input type="text" name="glucose" placeholder="Glucose" class="form-control"><br>
                        <input type="text" name="specificgravity" placeholder="Specific Gravity" class="form-control"><br>
                        <input type="text" name="color" placeholder="Color" class="form-control"><br>
<!--                        <textarea name="healthCondition" placeholder="Health Condition" class="form-control"></textarea><br>-->
                        <button style="float:right;" class="btn btn-success" onclick="redirectToAnotherPage()">Save</button>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Blood Test Form Template -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-box">
                    <div id="fullBloodTestForm" class="form-template" style="display: none;">
                        <h2>Full Blood Test </h2><br>
                        <!-- <form action="save.php" method="POST"> -->
                        <input type="text" name="name" placeholder="Name" class="form-control" required><br>
                        <input type="text" name="haemoglobin" placeholder="Haemoglobin" class="form-control" required><br>
                        <input type="text" name="whitebloodcount" placeholder="White Blood Count" class="form-control"><br>
                        <input type="text" name="platelets" placeholder="Platelets" class="form-control"><br>
                        <input type="text" name="mcv" placeholder="MCV" class="form-control"><br>
                        <input type="text" name="pcv" placeholder="PCV" class="form-control"><br>
                        <input type="text" name="rdw" placeholder="RDW" class="form-control"><br>
<!--                        <textarea name="rdw" placeholder="RDW" class="form-control"></textarea><br>-->
                        <button style="float:right;" class="btn btn-success" onclick="redirectToAnotherPage()" >Save</button>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lipid Test Form Template -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-box">
                    <div id="lipidTestForm" class="form-template" style="display: none;">
                        <h2>Lipid profileTest</h2><br>
                        <!-- <form action="save.php" method="POST"> -->
                        <input type="text" name="name" placeholder="Name" class="form-control" required><br>
                        <input type="text" name="cholestrol-total " placeholder="Cholestrol-Total " class="form-control" required><br>
                        <input type="text" name="triglycerides" placeholder="Triglycerides" class="form-control"><br>
                        <input type="text" name="cholestrol - H.D.L " placeholder="Cholestrol - H.D.L " class="form-control"><br>
                        <input type="text" name="cholestrol - L.D.L" placeholder="Cholestrol - L.D.L" class="form-control"><br>
                        <input type="text" name="vldl" placeholder="VLDL" class="form-control"><br>
                        <input type="text" name="cho/hdl" placeholder="Cho/HDl" class="form-control"><br>
                        <input type="text" name="ldl/hdl" placeholder="LDL/HDL" class="form-control"><br>
<!--                        <textarea name="healthCondition" placeholder="Health Condition" class="form-control"></textarea><br>-->
                        <button style="float:right;" class="btn btn-success" onclick="redirectToAnotherPage()">Save</button>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function showUrineTestForm() {
        hideAllForms();
        document.getElementById('urineTestForm').style.display = 'block';
    }

    function showFullBloodTestForm() {
        hideAllForms();
        document.getElementById('fullBloodTestForm').style.display = 'block';
    }

    function showLipidTestForm() {
        hideAllForms();
        document.getElementById('lipidTestForm').style.display = 'block';
    }

    function hideAllForms() {
        document.querySelectorAll('.form-template').forEach(function(form) {
            form.style.display = 'none';
        });
    }
    function redirectToAnotherPage(){
        console.log("Save button clicked");
        window.location.href = 'seniortechnision.php';

    }
</script>

</body>
</html>
