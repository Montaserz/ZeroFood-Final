<template>
  <div id="Orders">
    <v-row justify="center">
      <v-col cols="12">
        <old-order-card class="w-100" />
      </v-col>
    </v-row>
    <!-- <v-row
      v-if="
        (items.length == 0 && isOrderPage) ||
          (oldItems.length == 0 && !isOrderPage)
      "
      justify="center"
    >
      <v-col cols="12">
        <h1 class="title text-center">
          Your cart is empty 🛒
        </h1>
      </v-col>
      <v-col cols="auto">
        <v-img
          width="500px"
          :src="
            `https://cdn.dribbble.com/users/576558/screenshots/3820223/cart_icon.png`
          "
        />
      </v-col>
    </v-row> -->
  </div>
</template>

<script>
import CardOrder from '../components/Orders.vue'
import OldOrderCard from '../components/OrderDetails'
export default {
  name: 'Orders',
  components: {
    CardOrder,
    OldOrderCard
  },
  data() {
    return {
      items: [],
      oldItems: [],
      isOrderPage: false
    }
  },
  async created() {
    await this.getMyOldItems()
    console.log({ order: this.oldItems })
  },
  methods: {
    getItems() {
      this.items = JSON.parse(localStorage.getItem('items')) || []
    },
    getMyOldItems() {
      this.$axios.get('/user/orders').then(({ data }) => {
        for (let i in data) {
          this.$axios.get(`/meals/${data[i].meals_id}`).then(response => {
            data[i].meal = response.data
          })
        }
        console.log({ data })
        this.oldItems = data
      })
    },
    makeOrder() {
      let orderObject = {
        meal: [],
        quantity: []
      }
      for (let item of this.items) {
        orderObject.meal.push(item.id)
        orderObject.quantity.push(item.qty)
      }
      this.$axios.post('/user/orders/create', orderObject).then(({ data }) => {
        if (data.msg == 'Order Done') {
          this.$toasted
            .show(`Order has been completed successfully 💳`)
            .goAway(1500)
          this.items = []

          localStorage.setItem('items', null)
        }
      })
    }
  }
}
</script>

<style></style>
