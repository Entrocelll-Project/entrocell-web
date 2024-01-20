<?php 
session_start();
include 'functions.php';

if(!isset($_SESSION['user'])){
	header('Location: index.php');
}

$msisdn = $_SESSION['user'];
$balanceInfo = getBalance($msisdn);
// tarih kalan gün hesaplama
// Belirli bir tarih
$specifiedDate = new DateTime($balanceInfo[0]["endDate"]);

// Şu anki tarih
$currentDate = new DateTime();

// Kalan gün sayısını hesapla
$remainingDays = $currentDate->diff($specifiedDate)->format('%a');




setlocale(LC_TIME, 'tr_TR');
include 'inc/header.php';
?>
<body>
    <div class="container">

        <!-- Navigation -->
        <div class="nav">
            <div><?php echo strftime('%e %B %Y'); ?></div>
            <div><img id="navLogo"  src="assets/img/vectorized-white.png" alt=""></div>
            <div class="navInfoBox">
                <div id="navName"><?php echo $msisdn; ?></div>
				<span><a href="logout.php"><i id="navLogoutIcon" class="iconoir-log-out"></i></a></span>
            </div>
        </div>

        <section class="main">
            <div class="container"> 
                <div class="packageInfoBox">
                    
                    <div class="packageInfoBoxItem">
                        <small>Şu anda kullandığınız tarife</small>
                        <div>
                            <h2><?php echo $balanceInfo[0]["packageName"]; ?></h2>
                        </div>
                        
                    </div>

                    <div class="packageInfoBoxItem">
                        Kampanyanızın bitimine kalan süre
                        <div class="progress-bar-container">
                            <div class="progress-text"><i class="iconoir-clock"></i><?php echo $remainingDays; ?></div>
                            <div class="progress-bar-indicator" style="width:<?php echo ($remainingDays/360)*100?>%"></div>
                          </div>
                    </div>
                    <div class="packageInfoBoxItem">
                        Taahhüt Başlangıç Tarihi
                        <div>21.12.2023</div>
                        <div>Taahhüt Bitiş Tarihi</div>
                        <div><?php echo $balanceInfo[0]['endDate']; ?></div>
                    </div>
                </div>

                <h5 class="subtitle">Güncel Durum</h5>
                <section class="balanceArea">
                    <div class="balanceBox">
                        <h4 class="balanceTitle">İnternet</h4>
                        <hr>

                        <div class="radial-progress-bar" id="dataprogress">
                            <progress min="0" max="100" style="visibility:hidden;height:0;width:0;">75%</progress>
                        </div>

						<div>
                            Kalan Kullanım: <?php echo $balanceInfo[0]["remainingData"] / (1024); ?> MB
                        </div>
						
                        <div>
                            Toplam Kullanım: <?php echo $balanceInfo[0]["maxVolumeData"]/(1024); ?> MB
                        </div>
                        
                    </div>
                    
                    <div class="balanceBox">
                        <h4 class="balanceTitle">Dakika</h4>
                        <hr>

                        <div class="radial-progress-bar" id="voiceprogress">
                            <progress min="0" max="100" style="visibility:hidden;height:0;width:0;">75%</progress>
                        </div>

						<div>
                            Kalan Kullanım: <?php echo $balanceInfo[0]["remainingVoice"]; ?> Dakika
                        </div>
						
                        <div>
                            Toplam Kullanım: <?php echo $balanceInfo[0]["maxVolumeVoice"]; ?> Dakika
                        </div>
                        
                    </div>
                    

                    <div class="balanceBox">
                        <h4 class="balanceTitle">SMS</h4>
                        <hr>

                       <div class="radial-progress-bar" id="smsprogress">
							<progress min="0" max="100" style="visibility:hidden;height:0;width:0;"></progress>
					   </div>

						
						<div>
                            Kalan Kullanım: <?php echo $balanceInfo[0]["remainingSms"];?> SMS
                        </div>
                        <div>
                            Toplam Kullanım: <?php echo $balanceInfo[0]["maxVolumeSms"];?> SMS
                        </div>
                        
                    </div>
                    
                    
                </section>

                <div class="campaignBox">
                    <a href="gift.php"><h3>Haftalık kampanya seni bekliyor! Hemen tıkla hediyeni al!</h3></a>
                </div>

            </div>
        </section>

    </div>
</body>


<script>
	function setProgressValue(progressId, newValue) {
								const progressElement = document.getElementById(progressId);

								if (!progressElement) {
									console.error(`Element with ID '${progressId}' not found.`);
									return;
								}

								// Değerleri güncelle
								progressElement.value = newValue;

								// Stil kurallarını ekle
								progressElement.style.cssText = `--progress-value: ${newValue};`;

								// Animasyonu sıfırla ve yeniden başlat
								progressElement.style.animation = 'none';
								void progressElement.offsetWidth; // Force reflow
								progressElement.style.animation = null;
							}
</script>

<script>
setProgressValue('smsprogress', <?php echo ceil($balanceInfo[0]["remainingSms"]/$balanceInfo[0]["maxVolumeSms"]); ?>);
setProgressValue('dataprogress', <?php echo ceil($balanceInfo[0]["remainingData"]/$balanceInfo[0]["maxVolumeData"]); ?>);
setProgressValue('voiceprogress', <?php echo ceil($balanceInfo[0]["remainingVoice"]/$balanceInfo[0]["maxVolumeVoice"]); ?>);

</script>



<?php include 'inc/footer.php'; ?>
