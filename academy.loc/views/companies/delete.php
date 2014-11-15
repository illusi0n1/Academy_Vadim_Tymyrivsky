<!doctype html>
<html>
<head>
    <meta charset="utf-8" >
    <title> Academy </title>
</head>
<body>
<?php
require "../models/companies.php";
?>

<a href="?controller=companies&action=add"> Add company </a><br>
<a href="?controller=companies&action=display"> Display companies </a><br>
<a href="?controller=companies&action=search"> Search companies </a>

    <form action="" method="post">
        <table border="1">
            <tr>
                <th colspan="2">Delete company</th>
            </tr>
            <tr>
                <th>Select name</th>
                <th>
                    <select name="company_id_del">
                        <option selected disabled>None</option>
                        <?php
                        $company = new Companies();
                        $arr_companies = $company->selectIdNameFromCompanies();
                        for($i=0;$i<count($arr_companies);$i++) {
                            echo '<option value="'.$arr_companies[$i]->getId().'">'.$arr_companies[$i]->getName().'</option>';
                        }
                        ?>
                    </select>
                </th>
            </tr>
            <tr>
                <th colspan="2"><input type="submit" name="submit" value="Delete"></th>
            </tr>
        </table>
    </form>

<?php
if ($_POST["company_id_del"]) {
    $company_id_del = $_POST["company_id_del"];

    $company = new Companies();
    $result = $company->deleteCompany($company_id_del);
}
?>

</body>
</html>