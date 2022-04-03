<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $student = new StudentController();
    if($method == 'showLogin') {
        $student->showLogin();
    }

    if($method == 'login') {
        $student->login();
    }

    if($method == 'showRegister') {
        $student->showRegister();
    }

    if($method == 'register') {
        $student->Register();
    }

    if($method == 'showSettings') {
        $student->showSettings();
    }

    if($method == 'showChangePassword') {
        $student->showChangePassword();
    }

    if($method == 'editProfile') {
        $student->editProfile();
    }

    if($method == 'changePassword') {
        $student->changePassword();
    }

    if($method == 'showProfile') {
        $student->showProfile();
    }

    if($method == 'logout') {
        $student->logout();
    }
    
    

}

class StudentController {
    private $Path = "../students/";
    public function showLogin() {
        header('location: '.$this->Path.'login.php');
    }

    public function login() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['student_login'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $data = [
                    'email'=>$email,
                ];
                $error=[];
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($password)) {
                    array_push($error,"password requires");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                }  
                $student = selectOne('*','students',"email = '$email'");
                if (empty($student)) {
                    array_push($error,"this email not exist in Database");
                } 

                if (!empty($student) ) {
                    if(! password_verify($password,$student['password'])) {
                            array_push($error,"this password is invalid");
                    }
                }

                if(!empty($error))
                {
                    $_SESSION['oldData'] = $data;
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'login.php');
                    exit();
                }
                $fac = $this->getFacuty($student['fac_id']);
                $_SESSION['username'] = $student['name'];
                $_SESSION['student'] = $student;
                $_SESSION['student']['uni_fac'] = $fac['u_name'].' - '.$fac['name'];
                $_SESSION['msg'] = "Student Login Successfuly";
                $this->showProfile();
            }
        }
    }

    public function showRegister() {
        $joins = 'faculities f LEFT JOIN univerisities u ON f.uni_id = u.id GROUP BY f.id';
        $_SESSION['faculities'] = selectAll('u.name as u_name, f.*', $joins);
        if(!$_SESSION['faculities']) {
            header('location: ../errors/faculitiesError.php');
            exit();
        }
        header('location: '.$this->Path.'register.php');
    }

    public function Register() {
        $error=[];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['student_register'])) {
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $phone = trim($_POST['phone']);
                $fac_id = trim($_POST['fac_id']);
                $password = trim($_POST['password']);
                $confirm_password = trim($_POST['confirm_password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);

                $data = [
                    'name'=>$name,
                    'email'=>$email,
                    'phone'=>$phone,
                    'fac_id'=>$fac_id,
                    'password'=>$hashpassword
                ];
                $error=[];
                if (empty($name)) {
                    array_push($error,"email required");
                } 
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($password)) {
                    array_push($error,"password requires");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                }
                if (empty($confirm_password)) {
                    array_push($error,"confirm_password requires");
                } 
                if (strlen($confirm_password)>0 && strlen($confirm_password)<8) {
                    array_push($error,"this confirm_password less than 8 digit");
                }  
                if ($password!=$confirm_password) {
                    array_push($error,"passwords not matched");
                }
                if (empty($phone) || strlen($phone)<6 || !is_numeric($phone)) 
                {
                    if(empty($phone))
                    {
                        array_push($error,"phone required");
                    }
                    else if(strlen($phone)<8)
                    {
                        array_push($error,"Must be 8 digit");
                    }
                    else{
                        array_push($error,"phone number contains numbers only");
                    }
                } 

                $student = selectOne('*','students',"email = '$email'");
                if (!empty($student)) {
                    array_push($error,"this email exist in Database");
                } 

                if(!empty($error))
                {
                    $_SESSION['oldData'] = $data;
                    $_SESSION['errors'] = $error;
                    $this->showRegister();
                    exit();
                }
                $keys = implode(',',array_keys($data));
                $st_id = insert($keys,'students','?,?,?,?,?',array_values($data));
                if($st_id) {
                    $fac = $this->getFacuty($fac_id);
                    $_SESSION['username'] = $student['name'];
                    $_SESSION['student'] = $student;
                    $_SESSION['student']['uni_fac'] = $fac['u_name'].' - '.$fac['name'];
                    $_SESSION['msg'] = "Student Register Successfuly";
                }
                $this->showProfile();
            }
        }
    }

    public function getFacuty($id) {
        $joins = 'faculities f LEFT JOIN univerisities u ON f.uni_id = u.id where f.id='.$id.' GROUP BY f.id';
        $fac = selectOne('u.name as u_name, f.*', $joins);
        return $fac;
    }

    public function changePassword() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['change_password'])) {
                $confirm_password = trim($_POST['confirm_password']);
                $password = trim($_POST['password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $student_id = $_SESSION['student']['id'];
                $data = [
                    'password'=>$hashpassword,
                    'id'=>$student_id
                ];
                $error=[];
                if (empty($password)) {
                    array_push($error,"password required");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                } 
                if (empty($confirm_password)) {
                    array_push($error,"confirm_password required");
                } 
                if ($password!=$confirm_password) {
                    array_push($error,"passwords not matched");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $this->showChangePassword();
                    exit();
                }

                $success = update('password = ?','students',array_values($data),'id = ?');
                if($success) {
                    $_SESSION['student']['password'] = $hashpassword;
                    $_SESSION['msg'] = "Change Password Successfuly";
                    $this->showProfile();
                }

            }
        }
    }

    public function editProfile() {
        $error=[];
        $joins = 'faculities f LEFT JOIN univerisities u ON f.uni_id = u.id GROUP BY f.id';
        $_SESSION['faculities'] = selectAll('u.name as u_name, f.*', $joins);
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_profile'])) {
                $email = trim($_POST['email']);
                $name = trim($_POST['name']);
                $phone = trim($_POST['phone']);
                $fac_id = trim($_POST['fac_id']);
                $photoName = $_FILES['photo']['name'];
                if(!empty($photoName)) {
                    $photoSize = $_FILES['photo']['size'];
                    $photoTmp	= $_FILES['photo']['tmp_name'];
                    $photoAllowedExtension = array("jpeg", "jpg", "png");
                    $explode = explode('.', $photoName);
                    $photoExtension = strtolower(end($explode));
                }
                $student_id = $_SESSION['student']['id'];
                $data = [
                    'email'=>$email,
                    'name'=>$name,
                    'phone'=>$phone,
                    'fac_id'=>$fac_id,
                    'id'=>$student_id

                ];
                $error=[];
                if (! empty($photoName) && ! in_array($photoExtension, $photoAllowedExtension)) {
                    $error[] = 'This Extension Is Not <strong>Allowed</strong>';
                }
                if (! empty($photoName) && $photoSize > 4194304) {
                    $error[] = 'photo Cant Be Larger Than <strong>4MB</strong>';
                }
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($phone) || strlen($phone)<6 || !is_numeric($phone)) 
                {
                    if(empty($phone))
                    {
                        array_push($error,"phone required");
                    }
                    else if(strlen($phone)<8)
                    {
                        array_push($error,"Must be 8 digit");
                    }
                    else{
                        array_push($error,"phone number contains numbers only");
                    }
                } 
                if($email != $_SESSION['student']['email']) {
                    $result = selectOne('*','students',"email = '$email'");
                    if (!empty($result) ) {
                        array_push($error,"this email exist in Database");
                    } 
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showSettings();
                }

                $oldphoto = $_SESSION['student']['photo'];
                if(!empty($photoName)) {
                    $path = '../assets/images/students/'.$student_id;
                    if(!is_dir($path)) {
                        mkdir($path);
                    } 
                    if($oldphoto != null) {
                        unlink($path.'/'.$oldphoto);
                    }
                    move_uploaded_file($photoTmp, $path.'/'. $photoName);
                }
                $photo = !empty($photoName) ? $photoName : $oldphoto;
                if($photo) {
                    $data = [
                        'email'=>$email,
                        'name'=>$name,
                        'phone'=>$phone,
                        'fac_id'=>$fac_id,
                        'photo'=>$photo,
                        'id'=>$student_id
    
                    ];
                    $success = update('email = ? , name = ? , phone = ? , fac_id = ? , photo = ?','students',array_values($data),'id = ?');

                }
                else {
                    $success = update('email = ? , name = ? , phone = ?, fac_id = ? ','students',array_values($data),'id = ?');
                }
                if($success) {
                    $fac = $this->getFacuty($fac_id);
                    $_SESSION['username'] = $name;
                    $_SESSION['student']['name'] = $name; 
                    $_SESSION['student']['email'] = $email; 
                    $_SESSION['student']['phone'] = $phone; 
                    $_SESSION['student']['fac_id'] = $fac_id; 
                    $_SESSION['student']['photo'] = $photo; 
                    $_SESSION['student']['uni_fac'] = $fac['u_name'].' - '.$fac['name'];
                    $_SESSION['msg'] = "Edit Profile Successfuly";
                    $this->showProfile();
                }


            }
        }
    }

    public function showSettings() {
        $joins = 'faculities f LEFT JOIN univerisities u ON f.uni_id = u.id GROUP BY f.id';
        $_SESSION['faculities'] = selectAll('u.name as u_name, f.*', $joins);
        header('location: '.$this->Path.'settings.php');
    }

    public function showChangePassword() {
        header('location: '.$this->Path.'changePassword.php');

    }

    public function showProfile() {
        header('location: '.$this->Path);
    }



    public function logout(){
        unsetAllSession();
        unset($_SESSION['student']);
        unset($_SESSION['username']);
        header('location: ../');
    }
}