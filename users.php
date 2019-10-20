<?php
session_start();

include_once("Database.class.php");

$datab=new Database();
$pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);

$result_admin=$datab->getRow("SELECT login_admin,password_admin FROM Admin WHERE login_admin= ? AND password_admin= ?",[$_POST["username"],$_POST['pass']]);

$result_employe=$datab->getRow("SELECT id_specialite,login_employe,password_employe FROM Employe WHERE login_employe= ? AND password_employe= ?",[$_POST["username"],$_POST['pass']]);

$compare_employe=$datab->getRow("SELECT Role.id_role,Role.nom_role FROM Role INNER JOIN Employe ON Role.id_role=Employe.id_role");
if ($result_admin) {
    $_SESSION["login_admin"]=$result_admin["login_admin"];
    $_SESSION["id_admin"]=$result_admin["id_admin"];
    header("location:admin.php");
}
elseif ($result_employe){
                    $id_specialite=$result_employe["id_specialite"];
                    $specialite=$datab->getRow("SELECT nom_specialite FROM Specialite WHERE id_specialite=?",[$id_specialite]);
                    if ($specialite["nom_specialite"]==NULL) {
                        $_SESSION["id_secretaire"]=$result_employe["id_employe"];
                        $_SESSION["login_secretaire"]=$result_employe["login_employe"];
                        header("location:secretaire.php");
                    }
                    else{
                        $_SESSION["id_medecin"]=$result_employe["id_employe"];
                        $_SESSION["login_medecin"]=$result_employe["login_employe"];
                        $_SESSION["id_specialite"]=$result_employe["id_specialite"];
                        $_SESSION["nom_medecin"]=$result_employe["nom_employe"];
                        header("location:medecin.php");
        
            }
        }
else{
    echo "Login ou mot de passe incorrect.";
}
?>