<?php
function setError($error, $errorMessage) {
    $_SESSION['error'][$error] = $errorMessage;
}

function getError($inputName) {
    return isset($_SESSION['error'][$inputName]) ? $_SESSION['error'][$inputName] : "";
}

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
    $savedLocation = "store/" . uniqid() . "-" . $_FILES["contact_photo"]["name"];
    if ($_FILES['contact_photo']['name']) {
        $tempFile = $_FILES['contact_photo']['tmp_name'];
        if (in_array($_FILES['contact_photo']['type'], $supportedImageType)) {
            move_uploaded_file($tempFile, $savedLocation);
        } else {
            setError("contact_photo", "JPEG and PNG Only");
        }
    } else {
        setError("contact_photo", "Contact Photo is required");
    }

    $query = "INSERT INTO contact_list (contact_name, phone_number, contact_photo) VALUES ('$name', '$phone_number', '$savedLocation')";
    if (runQuery($query)) {
        echo "<script>location.href='index.php'</script>";
   }
}

function textFilter($text) {
    return stripslashes(htmlentities(trim($text)));
}

// Query
function runQuery($sql) {
    $con = connectionToDB();
    return mysqli_query($con, $sql) ? true : die("Query Fail : " . mysqli_error($con));
}

function contacts() {
    $sql = "SELECT * FROM contact_list";
    return fetchAll($sql);
}

function fetchAll($sql) {
    $query = mysqli_query(connectionToDB(), $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($rows, $row);
    }
    return $rows;
}

function old($inputName) {
    return isset($_POST[$inputName]) ? $_POST[$inputName] : "";
}