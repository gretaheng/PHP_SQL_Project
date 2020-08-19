<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>modification</title>
    <link rel="stylesheet" href="../source/for_m.css">
</head>
<body>
<div class="header">
    <h1 style="font-family:verdana;">Here you can modify information in the database.</h1>
</div>
<div class="topnav">
    <a href="../index.html">Home</a>
    <a href="../semifinal/front.html">Query</a>
    <a class="active" href="#home">Modification</a>
    <a href="../datawarehouse.html">DataWarehouse</a>
</div>
<div class = "pad">
    <div id="quotescointainer">
        <div id="quotesleft">
            <div class= "inside">
                <br><br><br>
                <h3>Update Celebrity</h3>
                <p> We have celebrities accounts number from <b>
                        <?php
                        require("db.php");
                        $query = "SELECT CONCAT('c', b) as q1
FROM
(SELECT MIN(CAST(SUBSTRING(c_account,2,maximum) AS UNSIGNED)) b
FROM
(SELECT max(length(c_account)) as maximum FROM Celebrities) a, 
Celebrities) lalala;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['q1'];
                        }
                        ?>
                    </b>to<b>
                        <?php
                        require("db.php");
                        $query = "SELECT CONCAT('c', b) as q1
FROM
(SELECT MAX(CAST(SUBSTRING(c_account,2,maximum) AS UNSIGNED)) b
FROM
(SELECT max(length(c_account)) as maximum FROM Celebrities) a, 
Celebrities) lalala;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['q1'];
                        }
                        ?>
                    </b>
                </p>
                <p>Although sometimes there might be some accounts number between the above range have not be
                    assigned to celebrities, we recommend you enter an account number in the range we provide.
                </p>
                <p> After enter the account number, you can select a column and enter the new value.
                <p> For gender, we only accept 'Male' or 'Female'. For age, please enter a non-negative integer.
                <form method= "post" action="upcele.php">
                    <div class="form-group">
                        <b>Account number is</b><br>
                        <input type="text"  name="p1" id ="p1"><br><br>
                        <select name="p2">
                            <option value="c_name">name</option>
                            <option value="c_age">age</option>
                            <option value="c_gender">gender</option>
                            <option value="c_occupation">occupation</option>
                        </select><br><br>
                        <b>new_value</b><br>
                        <input type="text" name = "p3" id = "p3"><br><br>
                    </div>
                    <input type="submit" class= "button" name="submit"/>
                    <br><br>
                </form>
            </div>
        </div>
        <div id="quotescenter">
            <div class= "inside">
                <br>
                <h3>Add scandal</h3>
                <P> Add scandal to Scandals table and update Get_involved_in table.</P>
                <p> We have scandal id from <b>
                        <?php
                        require("db.php");
                        $query = "SELECT MIN(s_id) b FROM Scandals;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['b'];
                        }
                        ?>
                    </b>to<b>
                        <?php
                        require("db.php");
                        $query = "SELECT MAX(s_id) b FROM Scandals;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['b'];
                        }
                        ?>
                    </b>
                </p>
                <p>Please notice future dates are not allowed in this form.</P>
                <form method= "post" action="addscan.php">
                    <div class="form-group">
                        <b>Scandal ID is</b><br>
                        <input type="number" name="a0" size="40" id ="a"><br>
                        <b> The date of scandal is</b><br>
                        <input type="date" id="txtDate" name = 'txtDate'
                               max='<?php echo date('Y-m-d');?>'/><br>
                        <b> The type of scandal is</b><br>
                        <select name="a2">
                            <option value="affair">affair</option>
                            <option value="crime">crime</option>
                            <option value="drug">drug</option>
                            <option value="plagerization">plagerization</option>
                        </select><br>
                        <b>If the scandal is truth or not</b><br>
                        <select name="a3">
                            <option value=0>False</option>
                            <option value=1>True</option>
                        </select><br>
                        <b>Brieftly describe the scandle</b><br>
                        <input type="text" name="a4" size="40" id ="a4"><br>
                        <b>Celebrities that get involved in this scandles</b><br>
                        <select size="8" name="a5">
                            <?php
                            require("db.php");
                            $query = "SELECT c_account, CONCAT(c_account,' ', c_name) as a FROM Celebrities;";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $acc = $row['c_account'];
                                    $name = $row['a'];
                                    echo "<option value=\"$acc\">$name</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <br>
                    <input type="submit" class= "button" name="submit" onClick="return empty()"/>
                    <br><br>
                </form>
            </div>
        </div>
        <div id="quotesright">
            <div class= "inside">
                <br>
                <h3>Add Weibo user</h3>
                <P>Insert a row in Celebrities/public table, and add it to Weibo_Users table</P>
                <p>Valid account number starts with 'c' or consists of numbers.</P>
                <p> We have celebrities accounts number from <b>
                        <?php
                        require("db.php");
                        $query = "SELECT CONCAT('c', b) as q1
FROM
(SELECT MIN(CAST(SUBSTRING(c_account,2,maximum) AS UNSIGNED)) b
FROM
(SELECT max(length(c_account)) as maximum FROM Celebrities) a, 
Celebrities) lalala;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['q1'];
                        }
                        ?>
                    </b>to<b>
                        <?php
                        require("db.php");
                        $query = "SELECT CONCAT('c', b) as q1
FROM
(SELECT MAX(CAST(SUBSTRING(c_account,2,maximum) AS UNSIGNED)) b
FROM
(SELECT max(length(c_account)) as maximum FROM Celebrities) a, 
Celebrities) lalala;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['q1'];
                        }
                        ?>
                    </b>
                </p>
                <p> We have public users accounts number from <b>
                        <?php
                        require("db.php");
                        $query = "SELECT MIN(CAST(p_account AS signed)) b FROM Public";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['b'];
                        }
                        ?>
                    </b>to<b>
                        <?php
                        require("db.php");
                        $query = "SELECT MAX(CAST(p_account AS signed)) b FROM Public;";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo $row['b'];
                        }
                        ?>
                    </b>
                </p>
                <p>We recommend you enter an account number larger than
                    the maximum account number.</p>
                <form method= "post" action="wu.php">
                    <div class="form-group">
                        <b>Account number is</b><br>
                        <input type="text"  name="acn" id ="acn"><br><br>
                        <b>Followers(a non-negative integer)</b><br>
                        <input type="number" name="m1" id ="m1"><br><br>
                        <b>Post frequency is(a float between 0 and 1)</b><br>
                        <input type="number" step=0.01 name="m2" id ="m2" placeholder="e.g.0.5"><br><br>
                        <b> influence score(an integer between 0 and 100)</b><br>
                        <input type="number" name="m3" id="m3" pattern="[0-9]{10}" placeholder="e.g.78"><br>
                        <br><input type="submit" class= "button" name="submit" />
                        <br><br><br><br>
                    </div>
                </form>
            </div>
        </div>
        <div id="quotescointainer">
            <div id="quotescenter">
                <div class= "inside2">
                    <br><br><br>
                    <h3>Delete Hashtags</h3>
                    <P> User could choose one hashtag and delete it.
                    </P>
                    <form method = "post" action="delhash.php">
                        <div class="form-group">
                            <select size="8" name="typeoption5">
                                <?php
                                require("db.php");
                                $query = "SELECT h_name as name FROM Weibo_hashtags;";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        echo "<option value=\"$name\">$name</option>";}
                                }
                                ?>
                            </select><br><br>
                            <button type="submit" class= "button">Delete</button><br>
                        </div>
                    </form>
                    <br><br><br>
                </div>
            </div>
            <div id="quotesleft">
                <div class= "inside2">
                    <br><br><br>
                    <h3>Delete Scandals</h3>
                    <P> Only fake scandals are allowed to delete.</P>
                    <p> Note that in the selection box, it shows the combination of scandal id and a boolean value.
                        As we only can delete fake scandals, so boolean value is 0.
                    </P>
                    <form method="post" action="delscan.php">
                        <div class="form-group">
                            <select size="8" name="typeoption4">
                                <?php
                                require("db.php");
                                $query = "SELECT s_id, concat(s_id,' ', s_truth_or_not) as name FROM Scandals WHERE
s_truth_or_not = 0;";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['s_id'];
                                        $name = $row['name'];
                                        echo "<option value=\"$id\">$name</option>";}
                                }
                                ?>
                            </select><br><br>
                            <button type="submit" class= "button">Delete</button><br><br><br>
                        </div>
                    </form>
                </div>
            </div>
            <div id="quotescenter">
                <div class= "inside2">
                    <br><br><br>
                    <h3>Delete Celebrity</h3><br>
                    <P>Choose one type of celebrity occupation that you want to delete and we will delete all
                        celebrities whose occupation is the one you choose.
                    </P>
                    <form method="post" action="delcele.php">
                        <div class="form-group">
                            <select size="8" name="typeoption3">
                                <?php
                                require("db.php");
                                $query = "SELECT c_occupation as name FROM Celebrities GROUP BY c_occupation;";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $name = $row['name'];
                                        echo "<option value=\"$name\">$name</option>";
                                    }
                                } ?>
                            </select><br><br>
                            <button type="submit" class= "button">Delete</button><br>
                        </div>
                    </form>
                </div>
            </div>
            <div id="quotesright">
                <div class= "inside2">
                    <br>
                    <h3>Update Meida</h3>
                    <P> You can insert media name and change its level and type.
                        We have media name, <b>'china0'</b> to <b>'china10897'</b>.
                        Other media names are not following the above pattern, e.g. Toutiao.
                    </P>
                    <P> For media level, only <b>'national', 'local' and 'worldwide'</b> are valid input.
                    </P>
                    <form method="post" action="upmedia.php">
                        <div class="form-group">
                            <b>Media name is</b><br>
                            <input type="text" name="f1" id ="f1", placeholder="e.g.china0"><br><br>
                            <b></b>
                            <b>Update value is</b><br>
                            <select name="f2">
                                <option value="m_level">Media Level</option>
                                <option value="m_Type">Media Type</option>
                            </select><br><br>
                            <b>New value is</b><br>
                            <input type="text" name="f3" id ="f3"><br><br>
                            <button type="submit" class= "button">Submit</button><br>
                        </div>
                    </form>

                </div>
            </div>
            <div id="quotescenter">
                <div class= "inside2">
                    <br><br><br><br>
                    <h3>Add Follows Relation</h3><br>
                    <P> The relationship is: public user follows celebrity weibo user. You can insert one
                        public user's account and the weibo's author(celebrity account),
                        we will add this relation for you.
                    </P>
                    <form method="post" action="addre.php">
                        <div class="form-group">
                            <b>Public User Account number is</b><br>
                            <input type="number" name="l1" id ="l1", placeholder="e.g.1079"><br><br>
                            <b>Celebrity Account number is</b><br>
                            <input type="text" name="l2" id ="l2", placeholder="e.g.c67"><br><br>
                            <button type="submit" class= "button">Submit</button><br>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
</body>
</html>
