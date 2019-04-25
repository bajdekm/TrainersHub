<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FitApp</title>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

@auth
        <script>
            window.authRole =@json(auth()->user()->roles->pluck('name') ),
                window.userId =@json(auth()->user()->id)
        </script>
    @endauth

</head>
{{--<body style="background-color: #FFFFF2">--}}
<body>
<!-- Section welcome / SECTION #1 -->
<div class="wrapper" id="app">
    @include('panel.navbar')
    @yield('content')
    @include('panel.footer')
</div>


{{--
<section id="landing-page" class="d-flex">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center flex-column">
            <div class="text-on">

                <h1>Znajdź najlepszego trenera w okolicy</h1>
                <p>Wiele lokalizacji - od siłowni i klubów, po zajęcia prywatne, grupowe i więcej.</p>
            </div>
            <div class="searcher container">

                <div class="form-inline mainFrom col-md-10 ml-auto mr-auto">
                    <div class="newIpt">
                        <div class="row">

                            <div class="md-form form-group">
                                <div class="col-md-4">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <input id="form2" class="form-control" placeholder="" type="text" name="name" autocomplete="off">
                                    <label for="form2" class="">Imie trenera</label>
                                </div>

                                <div class="col-md-4">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    <input id="form3" class="form-control" placeholder="" type="text" name="surname" autocomplete="off">
                                    <label for="form3" class="">Nazwisko trenera</label>
                                </div>
                                <button class="btn btn-desktop a-border mainBtn99 waves-effect waves-light" onclick="getUrl2()"><i class="fa fa-paper-plane-o ml-1"></i>Szukaj trenera</button>
                                <button class="btn-mobile search2" onclick="getUrl2()"><i class="fa fa-search"></i></button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 pr-0">
                        <div class="md-form form-group changer">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <input id="autocomplete" class="form-control" placeholder="" type="text" autocomplete="off">
                            <label for="autocomplete" class="">Wpisz lokalizacje</label>
                            <button class="btn btn-desktop a-border mainBtn waves-effect waves-light" onclick="getUrl()">Szukaj trenera <i class="fa fa-paper-plane-o ml-1"></i></button>
                            <button class="btn-mobile search" onclick="getUrl()"><i class="fa fa-search" aria-hidden="true"></i></button>
                            <button class="btn-mobile mainBtn2"><i class="fa fa-cog" aria-hidden="true"></i></button>
                            <button class="btn a-border btn-desktop mainBtn2 waves-effect waves-light"><i class="fa fa-cog" aria-hidden="true"></i></button>
                        </div>
                        <div id="livesearch"></div>
                    </div>

                </div>

                <div class="catLinks">
                    <a href="kategorie/fitness">Fitness</a>
                    <a href="kategorie/Crossfit">Crossfit</a>
                    <a href="kategorie/Trening-personalny">Trening personalny</a>
                    <a href="kategorie/Tenis">Tenis</a>

                    <a href="kategorie/Plywanie">Pływanie</a>
                    <a href="kategorie/Golf">Golf</a>
                    <a href="kategorie/Pilka-nozna">Piłka nożna</a>

                    <a href="kategorie/Squash">Squash</a>
                    <a href="kategorie/Boks">Boks</a>
                    <a href="kategorie/Zumba">Zumba</a>

                    <a href="kategorie/Pole-dance">Pole dance</a>
                    <a href="kategorie/Narty">Narty</a>
                    <a href="kategorie/Snowboard">Snowboard</a>

                    <a href="kategorie.php" class="moved">Wszystkie kategorie</a>
                </div>
            </div>
        </div>
    </div>

</section>
--}}

{{--
<section id="navi">
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg">

        <!-- Navbar brand -->
        <a class="navbar-brand" href="index.php"><img src="images/compress/5.png" alt="supertrener" class="img-fluid"></a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Links -->
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item">
                    <a class="nav-link active kids waves-effect waves-light" href="kids.php"><span class="k">K</span><span class="i">i</span><span class="d">d</span><span class="s">s</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active waves-effect waves-light" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="#anchor">Jak to działa?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="#blog">Blog</a>
                </li>
            </ul>
            <!-- Links -->
            <a href="biznes.php"><button class="btn btnBlue a-border btn-sm my-0 mr-2 waves-effect waves-light">Dla trenerów</button></a>
            <a href="login.php"><button class="btn a-border btn-sm my-0 mr-2 waves-effect waves-light" type="submit">Zaloguj się</button></a>
            <a href="account-choose.php"><button class="btn a-border btn-sm my-0 mr-5 waves-effect waves-light" type="submit">Zarejestruj się</button></a>
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->
</section>
--}}


{{--START--}}


{{--STOP--}}

<!-- SCRIPTS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/spinner.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>





<!-- search v2 -->
<script>
    $(document).ready(function() {
        $('.searcher').mouseleave(function() {
            $('.newIpt').removeClass("position show");
            $('.changer').removeClass("hide");
        });
    });

</script>

<!-- get img del -->
<script>
    $(document).ready(function() {
        var els = document.querySelectorAll('[id="imgAva"]');

        for (var i = 0; i < els.length; i++) {
            if (els[i].src == "https://supertrener.pl/images/upload/deleted") {
                els[i].src = "https://supertrener.pl/images/upload/random.png";
            } else if (els[i].src == 'https://supertrener.pl/images/upload/NULL') {
                els[i].src = 'https://supertrener.pl/images/upload/random.png'
            }
        }
    })

</script>

<!-- show hint info -->
<script>
    $(document).ready(function() {
        $('.fa-info-circle').hover(function() {
            $('.hint').toggle();
        })
    })

</script>


<!-- timer -->
<script>

/*    $(document).ready(function() {
        setTimeout(function() {
            var t = setInterval(runFunction, 1000);

            function runFunction() {
                var d = new Date();
                var d2 = new Date(2017, 12, 02, 0, 0, 0, 0);
                var milSec = d2 - d;
                var d3 = new Date(milSec);
                var nrDays = (Math.floor(d3 / 1000 / 60 / 60 / 24));
                var nrHours = (Math.floor(d3 / 1000 / 60 / 60)) % 24;
                var nrMin = (Math.floor(d3 / 1000 / 60)) % 60;
                var nrSec = (Math.floor(d3 / 1000)) % 60;
                document.getElementById("timer").innerHTML = nrDays + "<span>dni</span>" + nrHours + "<span>g</span>" + nrMin + "<span>m</span>" + nrSec + "<span>s</span>";
            }
        }, 100);
    });*/

</script>

<!-- google -->


<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.

        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')), {
                types: ['(cities)'],
                componentRestrictions: {
                    country: "pl"
                }
            });
    };

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNFt6DXW9cGZdmCIvpmuV3QOd4w9DzXk8&amp;libraries=places&amp;callback=initAutocomplete" async="" defer=""></script>






<!-- end ->
<!-- Widget -->

<!-- Searcher -->
<script>
    function getUrl() {
        var getHref = document.getElementById("autocomplete").value;

        var str = getHref;
        str = str.substring(0, str.indexOf(','));

        window.open('lokalizacja/' + str, '_self');
    }

    function getUrl2() {
        var form2 = document.getElementById("form2").value;
        var form3 = document.getElementById("form3").value;


        window.open('trener/' + form2 + form3, '_self');
    }

    $(document).ready(function() {
        $("#autocomplete").keypress(function(event) {
            if (event.keyCode == 13 || event.keyCode == 9) {
                $(event.target).blur();
                if ($(".pac-container .pac-item:first span:eq(3)").text() == "")
                    firstValue = $(".pac-container .pac-item:first .pac-item-query").text();
                else
                    firstValue = $(".pac-container .pac-item:first .pac-item-query").text() + ", " + $(".pac-container .pac-item:first span:eq(3)").text();
                event.target.value = firstValue;

                setTimeout(function() {
                    getUrl();
                }, 200);
            } else
                return true;
        });
    });

</script>

<script>
    // SMOOTH SCROLL
    // Select all links with hashes
    $('a[href*="#"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });

</script>

<div class="hiddendiv common"></div>

<script src="/js/app.js"></script>
{{--
<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        if(inp == null || inp == undefined){
            return null;
        }
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong style='color: green'>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    /*An array containing all the country names in the world:*/
    var cities = ['Warszawa','Kraków','Łódź','Wrocław','Poznań','Gdańsk','Szczecin','Bydgoszcz','Lublin','Katowice','Białystok','Gdynia','Częstochowa','Radom','Sosnowiec','Toruń','Kielce','Gliwice','Rzeszów','Zabrze','Olsztyn','Bielsko-Biała','Bytom','Ruda Śląska','Rybnik','Tychy','Gorzów Wielkopolski','Dąbrowa Górnicza','Elbląg','Płock','Opole','Zielona Góra','Wałbrzych','Włocławek','Tarnów','Chorzów','Koszalin','Kalisz','Legnica','Grudziądz','Słupsk','Jaworzno','Jastrzębie-Zdrój','Nowy Sącz','Jelenia Góra','Konin','Siedlce','Piotrków Trybunalski','Mysłowice','Inowrocław','Piła','Lubin','Ostrów Wielkopolski','Ostrowiec Świętokrzyski','Gniezno','Stargard','Suwałki','Głogów','Siemianowice Śląskie','Pabianice','Chełm','Zamość','Tomaszów Mazowiecki','Leszno','Stalowa Wola','Przemyśl','Kędzierzyn-Koźle','Łomża','Żory','Mielec','Tarnowskie Góry','Tczew','Ełk','Pruszków','Bełchatów','Świdnica','Będzin','Biała Podlaska','Zgierz','Piekary Śląskie','Racibórz','Legionowo','Ostrołęka','Świętochłowice','Zawiercie','Starachowice','Wejherowo','Puławy','Wodzisław Śląski','Skierniewice','Starogard Gdański','Tarnobrzeg','Radomsko','Skarżysko-Kamienna','Rumia','Krosno','Kołobrzeg','Dębica','Kutno','Otwock','Nysa','Piaseczno','Ciechanów','Zduńska Wola','Sieradz','Świnoujście','Żyrardów','Szczecinek','Chojnice','Świdnik','Mińsk Mazowiecki','Mikołów','Nowa Sól','Oświęcim','Bolesławiec','Jarosław','Knurów','Sanok','Malbork','Kwidzyn','Żary','Chrzanów','Sopot','Wołomin','Sochaczew','Oleśnica','Brzeg','Olkusz','Jasło','Cieszyn','Kraśnik','Czechowice-Dziedzice','Lębork','Dzierżoniów','Ostróda','Nowy Targ','Police','Iława','Czeladź','Myszków','Oława','Żywiec','Zgorzelec','Ząbki','Bielawa','Swarzędz','Mława','Łuków','Luboń','Augustów','Bochnia','Śrem','Giżycko','Grodzisk Mazowiecki','Września','Łowicz','Krotoszyn','Marki','Pruszcz Gdański','Brodnica','Czerwionka-Leszczyny','Gorlice','Nowy Dwór Mazowiecki','Turek','Kętrzyn','Kłodzko','Zakopane','Wyszków','Biłgoraj','Żagań','Świecie','Bielsk Podlaski','Jarocin','Wałcz','Pszczyna','Wągrowiec','Białogard','Sandomierz','Kluczbork','Bartoszyce','Szczytno','Lubliniec','Skawina','Kościan','Jawor','Kościerzyna','Wieluń','Nowa Ruda','Świebodzice','Reda','Koło','Piastów','Ostrów Mazowiecka','Goleniów','Polkowice','Środa Wielkopolska','Lubartów','Płońsk','Łaziska Górne','Zambrów','Grajewo','Mrągowo','Opoczno','Świebodzin','Lubań','Rydułtowy','Prudnik','Gryfino','Hajnówka','Działdowo','Wieliczka','Aleksandrów Łódzki','Andrychów','Kobyłka','Rawicz','Chełmno','Trzebinia','Końskie','Gostyń','Ozorków','Kamienna Góra','Orzesze','Tomaszów Lubelski','Łęczna','Józefów','Bieruń','Krasnystaw','Pisz','Chodzież','Pionki','Sulejówek','Wadowice','Pułtusk','Nakło nad Notecią','Kęty','Gostynin','Szamotuły','Sokółka','Sokołów Podlaski','Pyskowice','Złotów','Hrubieszów','Międzyrzecz','Sierpc','Bogatynia','Strzelce Opolskie','Oborniki','Myślenice','Kozienice','Kostrzyn nad Odrą','Łańcut','Łask','Radlin','Rawa Mazowiecka','Konstantynów Łódzki','Pleszew','Sulechów','Zielonka','Konstancin-Jeziorna','Braniewo','Libiąż','Przasnysz','Trzcianka','Garwolin','Międzyrzec Podlaski','Brzesko','Dęblin','Radzionków','Gubin','Nowogard','Krapkowice','Gryfice','Słubice','Bytów','Rypin','Strzegom','Lędziny','Busko-Zdrój','Łomianki','Olecko','Grójec','Milanówek','Lidzbark Warmiński','Ustka','Boguszów-Gorce','Radzyń Podlaski','Złotoryja','Namysłów','Łapy','Ustroń','Jelcz-Laskowice','Jędrzejów','Przeworsk','Świdwin','Choszczno','Ząbkowice Śląskie','Ropczyce','Solec Kujawski','Nisko','Władysławowo','Staszów','Limanowa','Lipno','Chełmża','Nowy Tomyśl','Kartuzy','Głowno','Łęczyca','Siemiatycze','Skoczów','Kępno','Lubsko','Ostrzeszów','Człuchów','Leżajsk','Morąg','Grodzisk Wielkopolski','Wschowa','Nidzica','Barlinek','Głuchołazy','Pszów','Darłowo','Żnin','Chojnów','Dębno','Wąbrzeźno','Słupca','Tuchola','Gołdap','Włodawa','Wolsztyn','Koluszki','Kłobuck','Złocieniec','Rabka-Zdrój','Brwinów','Mosina','Głubczyce','Trzebnica','Golub-Dobrzyń','Sławno','Pyrzyce','Węgrów','Wołów','Brzeziny','Błonie','Strzelin','Brzeg Dolny','Lubaczów','Aleksandrów Kujawski','Pasłęk','Góra','Mogilno','Szprotawa','Janów Lubelski','Szydłowiec','Krosno Odrzańskie','Zdzieszowice','Drawsko Pomorskie','Dąbrowa Tarnowska','Miechów','Milicz','Warka','Węgorzewo','Góra Kalwaria','Brzeszcze','Myślibórz','Wronki','Kowary','Nowa Dęba','Puck','Koronowo','Radzymin','Rogoźno','Pińczów','Wisła','Czarnków','Nowe Miasto Lubawskie','Krynica-Zdrój','Parczew','Miastko','Niepołomice','Międzychód','Ciechocinek','Biskupiec','Dobre Miasto','Kolno','Ożarów Mazowiecki','Włoszczowa','Wasilków','Bystrzyca Kłodzka','Drezdenko','Łobez','Bukowno','Murowana Goślina','Syców','Mońki','Sztum','Krzeszowice','Sulęcin','Kudowa-Zdrój','Trzebiatów','Strzelce Krajeńskie','Karczew','Maków Mazowiecki','Lubawa','Nowy Dwór Gdański','Czersk','Ryki','Skwierzyna','Blachownia','Puszczykowo','Kożuchów','Czarna Białostocka','Poniatowa','Pieszyce','Olesno','Opalenica','Szubin','Wysokie Mazowieckie','Kostrzyn','Sucha Beskidzka','Ustrzyki Dolne','Sępólno Krajeńskie','Kolbuszowa','Środa Śląska','Lwówek Śląski','Ozimek','Chełmek','Kruszwica','Ziębice','Stary Sącz','Wojkowice','Janikowo','Kamień Pomorski','Orneta','Pobiedziska','Oborniki Śląskie','Żuromin','Strzyżów','Wolbrom','Grodków','Opole Lubelskie','Prabuty','Poręba','Wieruszów','Suchedniów','Jastrowie','Imielin','Kalety','Żychlin','Połczyn-Zdrój','Połaniec','Pelplin','Chocianów','Lidzbark','Zwoleń','Witkowo','Tłuszcz','Pniewy','Praszka','Paczków','Mszana Dolna','Trzemeszno','Zelów','Poddębice','Barcin','Olsztynek','Nasielsk','Zawadzkie','Brzozów','Kórnik','Sędziszów Małopolski','Miasteczko Śląskie','Tuszyn','Chojna','Gniewkowo','Barczewo','Zbąszyń','Czaplinek','Białobrzegi','Sławków','Łosice','Skarszewy','Łazy','Sobótka','Witnica','Gryfów Śląski','Żarów','Gniew','Szklarska Poręba','Rudnik nad Sanem','Pajęczno','Łochów','Opatów','Bełżyce','Twardogóra','Kłodawa','Tuchów','Sędziszów','Koźmin Wielkopolski','Piława Górna','Rzepin','Sianów','Polanica-Zdrój','Głuszyca','Niemodlin','Gogolin','Żukowo','Sułkowice','Piechowice','Żmigród','Przemków','Mszczonów','Dobczyce','Kąty Wrocławskie','Sulejów','Lubawka','Buk','Krzyż Wielkopolski','Nowe','Dynów','Proszowice','Nowa Sarzyna','Działoszyn','Koniecpol','Przysucha','Kietrz','Głogów Małopolski','Sieraków','Czarne','Grybów','Siechnice','Maków Podhalański','Stronie Śląskie','Wieleń','Lewin Brzeski','Stąporków','Wołczyn','Szczawnica','Piwniczna-Zdrój','Karlino','Więcbork','Pieńsk','Lądek-Zdrój','Dąbrowa Białostocka','Boguchwała','Stęszew','Radziejów','Lipsko','Terespol','Strzelno','Ścinawa','Orzysz','Szczawno-Zdrój','Choroszcz','Głogówek','Pakość','Szczyrk','Jedlicze','Kazimierza Wielka','Susz','Sejny','Lesko','Śmigiel','Dzierzgoń','Radymno','Kuźnia Raciborska','Międzyzdroje','Siewierz','Szczytna','Bolków','Czempiń','Jordanów','Szczebrzeszyn','Debrzno','Jaworzyna Śląska','Wyrzysk','Bychawa','Nowogród Bobrzański','Odolanów','Zagórz','Zbąszynek','Muszyna','Otmuchów','Iłża','Brusy','Bierutów','Jedlina-Zdrój','Wolin','Karpacz','Łaskarzew','Borne Sulinowo','Duszniki-Zdrój','Ciechanowiec','Nowe Skalmierzyce','Reszel','Pilzno','Kcynia','Ożarów','Brześć Kujawski','Biecz','Ruciane-Nida','Supraśl','Raciąż','Leśna','Kalwaria Zebrzydowska','Zduny','Korsze','Krośniewice','Łabiszyn','Rejowiec Fabryczny','Żarki','Golina','Olszyna','Jasień','Woźniki','Krzepice','Piotrków Kujawski','Bytom Odrzański','Pilawa','Chęciny','Słomniki','Mrocza','Ogrodzieniec','Kalisz Pomorski','Resko','Zawidów','Szamocin','Świeradów-Zdrój','Nowy Staw','Skaryszew','Mieroszów','Górowo Iławeckie','Kowalewo Pomorskie','Kleczew','Nowogrodziec','Żabno','Bobolice','Czerwieńsk','Krobia','Szczucin','Skoki','Gąbin','Serock','Tarczyn','Biała Piska','Płoty','Janowiec Wielkopolski','Lipiany','Żelechów','Mirsk','Sokołów Małopolski','Babimost','Nałęczów','Iłowa','Drzewica','Okonek','Małogoszcz','Chmielnik','Nowe Miasto nad Pilicą','Sława','Ośno Lubuskie','Mikołajki','Jastarnia','Podkowa Leśna','Brańsk','Wojcieszów','Barwice','Ujście','Jabłonowo Pomorskie','Łeba','Krajenka','Dobrodzień','Kępice','Skała','Pruchnik','Szczekociny','Kargowa','Byczyna','Rymanów','Przedbórz','Zator','Sompolno','Skępe','Hel','Toszek','Halinów','Prochowice','Strumień','Tyczyn','Miłosław','Nekla','Mieszkowice','Skórcz','Małomice','Kowal','Stryków','Rakoniewice','Szczuczyn','Tarnogród','Rzgów','Alwernia','Gołańcz','Kock','Wojnicz','Tuliszków','Łasin','Złoczew','Kolonowskie','Zwierzyniec','Jeziorany','Warta','Maszewo','Gozdnica','Miejska Górka','Biała Rawska','Zakroczym','Kańczuga','Kobylin','Pyzdry','Chociwel','Michałowo','Myszyniec','Dobiegniew','Lubraniec','Ćmielów','Ślesin','Glinojeck','Niemcza','Krasnobród','Kunów','Radomyśl Wielki','Uniejów','Zagórów','Lwówek','Oleszyce','Łobżenica','Mirosławiec','Margonin','Węgliniec','Polanów','Wilamowice','Bobowa','Baborów','Drobin','Recz','Bojanowo','Pieniężno','Chorzele','Złoty Stok','Kałuszyn','Ryn','Daleszyce','Poniec','Węgorzyno','Sulmierzyce','Kamieńsk','Nowe Miasteczko','Ryglice','Wąchock','Knyszyn','Cybinka','Wąsosz','Tolkmicko','Książ Wielkopolski','Radłów','Golczewo','Izbica Kujawska','Rydzyna','Wysoka','Nowy Wiśnicz','Bardo','Dziwnów','Różan','Międzylesie','Brzostek','Leśnica','Wyszogród','Stoczek Łukowski','Prószków','Piaski','Kłecko','Annopol','Miłakowo','Pełczyce','Czerniejewo','Czyżew','Kazimierz Dolny','Łęknica','Torzym','Koprzywnica','Pasym','Borek Wielkopolski','Tychowo','Gorzów Śląski','Józefów','Biała','Krynki','Trzciel','Zabłudów','Bisztynek','Radków','Ciężkowice','Frombork','Gościno','Trzcińsko-Zdrój','Lipsk','Koziegłowy','Miłomłyn','Świątniki Górne','Wolbórz','Dobrzany','Mogielnica','Obrzycko','Międzybórz','Stawiski','Świerzawa','Rychwał','Kamień Krajeński','Dobra','Czchów','Człopa','Drawno','Wiązów','Szepietowo','Dobrzyń nad Wisłą','Prusice','Suchowola','Bodzentyn','Błaszki','Osieczna','Biały Bór','Zalewo','Ostrów Lubelski','Nowogród','Krzanowice','Łaszczów','Kosów Lacki','Sieniawa','Błażowa','Tyszowce','Dukla','Kisielice','Żerków','Drohiczyn','Narol','Dąbie','Raszków','Sępopol','Pogorzela','Lubniewice','Ińsko','Szadek','Tykocin','Osiek','Ostroróg','Brok','Grabów nad Prosną','Nieszawa','Cieszanów','Tuczno','Lubomierz','Pilica','Jutrosin','Bieżuń','Mikstat','Goniądz','Radzyń Chełmiński','Chodecz','Korfantów','Zawichost','Sośnicowice','Iwonicz-Zdrój','Młynary','Mordy','Wleń','Wielichowo','Przedecz','Ujazd','Jedwabne','Przecław','Nowe Brzesko','Zakliczyn','Cedynia','Krzywiń','Rajgród','Moryń','Stawiszyn','Dolsk','Baranów Sandomierski','Frampol','Ulanów','Suchań','Dobra','Kołaczyce','Górzno','Lubień Kujawski','Krynica Morska','Kleszczele','Szlichtyngowa','Skalbmierz','Nowe Warpno','Suraż','Działoszyce','Wyśmierzyce','Siedliszcze','Rejowiec','Modliborzyce','Urzędów','Lubycza Królewska','Mrozy','Zaklików','Czarna Woda','Stopnica','Morawica','Jaraczewo','Opatówek','Chocz','Dobrzyca','Stepnica','Mielno'];
    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("city"), cities);
</script>
--}}
<style>
    #wrapper {
        background-color: white;
    }
    #footer {
        background-image: url('/img/forest_footer.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        padding-top: 50px;
        margin-top: 125px; }
    #footer h4 {
        font-family: 'Bebas Neue';
        color: #E7E9E9; }
    #footer p,
    #footer a {
        color: #E7E9E9;
        font-size: 0.9em; }
    #footer a {
        line-height: 30px; }
    #footer a:hover {
        color: white; }
    #footer a i {
        color: #FEF751; }
    #footer .desc p {
        margin-right: 40px; }
    #footer .desc .socialBar {
        color: #b2b2b2;
        font-size: 1.2em; }
    #footer .desc .socialBar .fa {
        margin-left: 20px;
        cursor: pointer; }
    #footer .desc .socialBar .fa:first-child {
        margin-left: 0; }
    #footer .desc .socialBar .fa:hover {
        color: white; }
    #footer .desc .socialBar .fa-facebook {
        color: #365899; }
    #footer .desc .socialBar .fa-snapchat-ghost {
        color: #F2EF00; }
    #footer .desc .socialBar .fa-instagram {
        color: #A292B3; }
    #footer .copy {
        margin-top: 50px;
        text-align: center;
        border-top: 1px solid #6a6a6a; }
    #footer .copy p {
        padding-top: 30px;
        padding-bottom: 30px;
        font-size: 0.8em;
        font-weight: 500; }
</style>
</body>
</html>
