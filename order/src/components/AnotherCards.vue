<template>
  <div id="CardsLooks">
    <v-hover v-slot:default="{ hover }">
      <v-card
        class="mx-auto"
        color="grey lighten-4"
        max-width="600"
        height="500px"
      >
        <v-img height="300px" :src="item.picture">
          <v-expand-transition>
            <div
              v-if="hover"
              :style="`background-color: #00b894 !important;`"
              class=" justify-content-center aling-items-center transition-fast-in-fast-out v-card--reveal text-center display-3 white--text"
              style="height: 100%;"
            >
              Order now!
              <br>
              <br>
              -->
            </div>
          </v-expand-transition>
        </v-img>
        <v-card-text
          class="pt-10"
          style="position: relative;font-size: 18px !important;"
        >
          <v-btn
            absolute
            :style="`background-color: #00b894 !important;`"
            class="white--text"
            large
            right
            top
            fab
            @click="addToCard(item)"
          >
            <strong>order</strong>
          </v-btn>
          <h5
            class="display-1 font-weight-light mb-2"
            style="color: #00b894 !important;font-size: 26px !important;"
          >
            <strong>{{ item.name }}</strong> <br> ${{ item.price }}
          </h5>
          <div class="font-weight-light title mb-2">
            <p style="font-size: 18px !important;">
              {{ item.info }}
            </p>
          </div>
        </v-card-text>
      </v-card>
    </v-hover>
  </div>
</template>

<script>
export default {
  name: 'CardsLooks',
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data() {
    return {}
  },
  methods: {
    addToCard(item) {
      if (this.$store.getters.loggedIn)
        return this.$toasted
          .show(`Please login first! 😃`, {
            theme: 'bubble',
            position: 'bottom-right',
            action: [
              {
                text: 'Close',
                onClick: (e, toastObject) => {
                  toastObject.goAway(0)
                }
              }
            ]
          })
          .goAway(3000)
      this.$store.dispatch('getMyUser')
      let user = this.$store.getters.user
      if (parseInt(user.balance) < item.price)
        return this.$toasted
          .show(`Whoops, You don't have enough money to order this meal 😃!`, {
            theme: 'bubble',
            position: 'bottom-right',
            action: [
              {
                text: 'Cancel',
                onClick: (e, toastObject) => {
                  toastObject.goAway(0)
                }
              }
            ]
          })
          .goAway(2500)
      this.$axios
        .post('/user/orders/create', { meals_id: item.id })
        .then(({ data }) => {})
      this.$toasted
        .show(`${item.name} ordered successfully 🛒, enjoy!`, {
          theme: 'bubble',
          position: 'bottom-right',
          action: [
            {
              text: 'Cancel',
              onClick: (e, toastObject) => {
                toastObject.goAway(0)
              }
            }
          ]
        })
        .goAway(1500)
    }
  }
}
</script>

<style></style>
