<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/checker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/226b6b947f.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="js/checker.js"></script>
    <title>Wibu-Checker</title>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <h2>Wibu<br>Checker</h2>
            <ul>
                <li class="tandain"><a class="tablinks" data-cheker="gate1" onclick="openCity(event, 'London')"
                        id="defaultOpen"><i class="fas fa-torii-gate "></i>Gate 1</a></li>
                <li class="tandain"><a class="tablinks" data-cheker="gate2" onclick="openCity(event, 'Paris')"><i
                            class="fas fa-torii-gate "></i>Gate 2</a>
                </li>
                <li class="tandain"><a class="tablinks" data-cheker="gate3" onclick="openCity(event, 'Tokyo')"><i
                            class="fas fa-torii-gate "></i>Gate 3</a>
                </li>
            </ul>
        </div>

        <div id="London" class="tabcontent">
            <div class="form-group">
                <label class="CreditCard_Gate1" for="CreditCard_Gate1">Credit Card Gate 1</label>
                <textarea class="form-control" id="CreditCard_Gate1" cols="40" rows="5"></textarea>
                <div class="buttonHolder">
                    <input name="tatakae" style="" type="submit" class="startbtn" value="START"></input>
                </div>
                <p style="text-align: center;">Charge : 0 USD<br>Live -2 CRE / Dead -1 Cre<br>RECHECK IF UNKNOWN</p>
                <p style="text-align: center;" class="loading" data-text="Checking…">Checking…</p>
                <label class="Label_Gate1" for="Label_Live_Gate1">Results Live</label>
                <textarea class="form-control" id="Results_live_Gate1" name="Results_live_Gate3" cols="90" rows="5"
                    value="tytyd"></textarea>
                <label class="Label_Gate1" for="Label_Dead_Gate1">Results Dead</label>>

                <textarea class="form-control" id="Results_dead_Gate1" name="Results_dead_Gate3" cols="90" rows="5"
                    value="tytyd"></textarea>
            </div>
        </div>

        <div id="Paris" class="tabcontent">
            <div class="form-group">
                <label class="CreditCard_Gate2" for="CreditCard_Gate2">Credit Card Gate 2</label>
                <textarea class="form-control" id="CreditCard_Gate2" cols="40" rows="5"></textarea>
                <div class="buttonHolder">
                    <input name="tatakae" style="" type="submit" class="startbtn" value="START"></input>
                </div>
                <p style="text-align: center;">Charge : 0 USD<br>Live -2 CRE / Dead -1 Cre<br>RECHECK IF UNKNOWN
                </p>
                <p style="text-align: center;" class="loading" data-text="Checking…">Checking…</p>
                <label class="Label_Gate2" for="Label_Live_Gate2">Results Live</label>
                <textarea class="form-control" id="Results_live_Gate2" name="Results_live_Gate2" cols="90" rows="5"
                    value="tytyd"></textarea>
                <label class="Label_Gate2" for="Label_Dead_Gate2">Results Dead</label>
                <textarea class="form-control" id="Results_dead_Gate2" name="Results_dead_Gate2" cols="90" rows="5"
                    value="tytyd"></textarea>
            </div>
        </div>

        <div id="Tokyo" class="tabcontent">
            <div class="form-group">
                <label class="CreditCard_Gate3" for="CreditCard_Gate3">Credit Card Gate 3</label>
                <textarea class="form-control" id="CreditCard_Gate3" name="CreditCard_Gate3" cols="40"
                    rows="5"></textarea>
                <div class="buttonHolder">
                    <input name="tatakae" style="" type="submit" class="startbtn" value="START"></input>
                </div>
                <p style="text-align: center;">Charge : 0 USD<br>Live -2 CRE / Dead -1 Cre<br>RECHECK IF UNKNOWN</p>
                <p style="text-align: center;" class="loading" data-text="Checking…">Checking…</p>
                <label class="Label_Gate3" for="Label_Live_Gate3">Results Live</label>
                <textarea class="form-control" id="Results_live_Gate3" name="Results_live_Gate3" cols="90"
                    rows="5"></textarea>
                <label class="Label_Gate3" for="Label_Dead_Gate3">Results Dead</label>
                <textarea class="form-control" id="Results_dead_Gate3" name="Results_dead_Gate3" cols="90"
                    rows="5"></textarea>
            </div>
        </div>

        <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks, tandain;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
</body>

</html>