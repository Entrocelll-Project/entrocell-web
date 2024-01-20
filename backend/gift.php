<?php 


session_start();

if(!isset($_SESSION['user'])){
	header('Location: index.php');
}
	

include 'inc/functions.php';
include 'inc/header.php';


$msisdn = $_SESSION['user'];
?>

<body>

    

    <div class="container">

        <!-- Navigation -->
        <div class="nav">
            <div>Anasayfa</div>
            <div><img id="navLogo"  src="assets/img/vectorized-white.png" alt=""></div>
            <div class="navInfoBox">
                <div id="navName"><?php echo $msisdn;?></div>
				<span><a href="logout.php"><i id="navLogoutIcon" class="iconoir-log-out"></i></a></span>
            </div>
        </div>

        <section class="main">
            <div id="confetti-container"></div>
            <div class="container">

                <div class="prizeArea ">
                    <div class="prizeBox ">
                        <i class="iconoir-gift"></i>
                        <div>
                            <h3 class="prizeName">Hediye 1</h3>
                            <button onclick="clickClaim()">ÖDÜLÜ AL</button>
                        </div>
                    </div>
                    <div class="prizeBox ">
                        <i class="iconoir-gift"></i>
                        <div>
                            <h3 class="prizeName">Hediye 2</h3>
                            <button onclick="clickClaim()">ÖDÜLÜ AL</button>
                        </div>
                    </div>
                    <div class="prizeBox ">
                        <i class="iconoir-gift"></i>
                        <div>
                            <h3 class="prizeName">Hediye 3</h3>
                            <button onclick="clickClaim()">ÖDÜLÜ AL</button>
                        </div>
                    </div>
                    
                </div>

               
                

            </div>

        </section>

    </div>
</body>

<script>
    function clickClaim(){

        let gifts=["5 GB İnternet", "200 sms", "50 dakika"];

        showConfetti();

        let randomGift = gifts[Math.floor(Math.random() * 3)];


        Swal.fire({
            title: "Tebrikler!",
            text: randomGift + " kazandınız",
            icon: "success"
        }).then(
            function (){
                window.location.href = "dashboard.php";

            }
        );


    }
</script>
<?php include 'inc/footer.php'; ?>
