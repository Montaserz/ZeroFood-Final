<template>
  <v-footer dark padless>
    <v-card class="flex" flat tile>
      <v-card-text class="py-2 white--text text-center">
        {{ new Date().getFullYear() }} — <strong>Food4All</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
export default {
  name: 'Footer',
  data: () => ({
    icons: [
      'fab fa-facebook',
      'fab fa-twitter',
      'fab fa-google-plus',
      'fab fa-linkedin',
      'fab fa-instagram'
    ]
  })
}
</script>

<style>
a {
  text-decoration: none !important;
  color: white !important;
  text-align: left !important;
}

.footer-payments .logo-payments {
  height: 22px;
  margin: 0;
}

.footer-payments .logo-payments {
  display: inline-block;
  height: 17px;
  margin-top: 10px;
  overflow: hidden;
  vertical-align: middle;
}

.footer-payments .logo-payments img.visa {
  height: 14px;
}

.visa {
  width: 50px !important;
}

.mastercard {
  width: 120px !important;
}

.paypal {
  width: 80px !important;
}

.footer-payments .logo-payments img.mastercard {
  height: 14px;
}
</style>
