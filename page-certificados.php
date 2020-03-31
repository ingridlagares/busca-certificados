<?php get_header()?>

<div class="wrap">
<form class="form-basic" method="post" action="">

            <div class="form-title-row">
                <h1>Certificado</h1>
            </div>

            <div class="form-row">
                <label>
                    <span>Por favor, insira seu primeiro e último nomes</span>
                    <input type="text" name="user_name">
                </label>
            </div>

            <div class="form-row">
                <input type="hidden" name="action" value="nova_consulta"/>
                <p align="center"><input type="submit"  value="Consultar" tabindex="6" id="submit" name="send" /></p>
            </div>

          </form>
<?php
if(isset($_POST['send'])) {
  $name = trim($_POST['user_name']);
  if(empty($name)) {
    echo '<div class="error">Insira seu nome.</div>';
  } else {
      consulta_certificado($name);
      ?>
      <!-- <script>window.location = "<?php echo home_url('/thank-you/');?>"</script> -->

      <?php
    }
  }
?>
</div>
<?php get_footer()?>