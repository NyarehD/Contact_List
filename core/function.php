<?php
// General functions

function setError($error, $errorMessage) {
    $_SESSION['error'][$error] = $errorMessage;
}

function getError($inputName) {
    return isset($_SESSION['error'][$inputName]) ? $_SESSION['error'][$inputName] : "";
}

function textFilter($text) {
    return stripslashes(htmlentities(trim($text)));
}

function redirect($l) {
    header("location:$l");
}

function linkTo($l) {
    echo "<script>location.href='$l'</script>";
}


function old($inputName) {
    return isset($_POST[$inputName]) ? $_POST[$inputName] : "";
}

// Query
function runQuery($sql) {
    $con = connectionToDB();
    return mysqli_query($con, $sql) ? true : die("Query Fail : " . mysqli_error($con));
}

function fetch($sql) {
    $query = mysqli_query(connectionToDB(), $sql);
    return mysqli_fetch_assoc($query);
}

function fetchAll($sql) {
    $query = mysqli_query(connectionToDB(), $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($rows, $row);
    }
    return $rows;
}


// For Contact CRUD
function contacts() {
    return fetchAll("SELECT * FROM contact_list");
}

function contact($id) {
    return fetch("SELECT * FROM contact_list WHERE id='$id'");
}

function contactDelete($id) {
    $sql = "DELETE FROM contact_list WHERE id=$id";
    return runQuery($sql);
}

$savedLocation = "";
function contactUpdate($id) {
    global $savedLocation;
    $name = $_POST['contact_name'];
    $phone_number = $_POST['phone_number'];
    $sql = "UPDATE contact_list SET contact_name='$name',phone_number='$phone_number',contact_photo='$savedLocation' WHERE id=$id";
    if (runQuery($sql)) {
        linkTo("index.php");
    }
}

function contactAdd() {
    global $savedLocation;
    $name = textFilter($_POST['contact_name']);
    $phone_number = textFilter($_POST['phone_number']);
    $sql = "INSERT INTO contact_list (contact_name, phone_number, contact_photo) VALUES ('$name','$phone_number','$savedLocation')";
    if (runQuery($sql)) {
        linkTo("index.php");
    }
}

// Form validation for contact add
function validate() {
    $name = "";
    $phone_number = "";
    $photo = "";
    $errorStatus = 0;
    // Validating contact_name
    if (empty(($_POST['contact_name']))) {
        setError("contact_name", "Name is required");
        $errorStatus = 1;
    } elseif (!preg_match("/^[a-zA-Z' ]*$/", $_POST['contact_name'])) {
        setError('contact_name', "Only letters and white space are allowed");
        $errorStatus = 1;
    } else {
        if (strlen($_POST["contact_name"]) < 4) {
            setError("contact_name", "Name is too short");
            $errorStatus = 1;
        } elseif (strlen($_POST["contact_name"] > 20)) {
            setError("contact_name", "Name is too long");
        } else {
            $name = textFilter($_POST["contact_name"]);
        }
    }

    // Validating phone_number
    if (empty($_POST["phone_number"])) {
        setError("phone_number", "Phone is required");
        $errorStatus = 1;
    } elseif (!preg_match("/[0-9+ ]/", $_POST["phone_number"])) {
        setError("phone_number", "Phone format incorrect");
        $errorStatus = 1;
    } else {
        $phone_number = textFilter($_POST["phone_number"]);
    }

    // Validating contact_photo
    $supportedImageType = ['image/png', 'image/jpeg'];
    $GLOBALS['savedLocation'] = "store/" . uniqid() . "-" . $_FILES["contact_photo"]["name"];
    if ($_FILES['contact_photo']['name']) {
        $tempFile = $_FILES['contact_photo']['tmp_name'];
        if (in_array($_FILES['contact_photo']['type'], $supportedImageType)) {
            move_uploaded_file($tempFile, $GLOBALS['savedLocation']);
        } else {
            setError("contact_photo", "JPEG and PNG Only");
            $errorStatus = 1;
        }
    } else {
        setError("contact_photo", "Contact Photo is required");
        $errorStatus = 1;
    }

    if ($errorStatus === 0) {
        return true;
    } else {
        return false;
    }
}