<template>
  <div id="CartView">
    <v-simple-table>
      <template v-slot:default>
        <tbody class="py-4 my-3">
          <tr class="py-4 my-3" v-for="(item, index) in items" :key="index">
            <td>
              <v-img
                width="64"
                aspect-ratio="1"
                class="grey lighten-2"
                :src="item.image"
              ></v-img>
            </td>
            <td class="text-left">{{ item.name }}</td>
            <td>{{ item.price }}</td>
            <td>QTY : {{ item.qty }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <v-row justify="center" class="w-100">
      <v-col cols="auto">
        <b class="text-center w-50">Total Price : {{ totalPrice }} 💸</b>
      </v-col>
      <v-col cols="auto">
        <b class="text-center w-50">Total Quantities : {{ totalQTY }} 🛒</b>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'CartView',
  props: {
    items: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      totalPrice: 0,
      totalQTY: 0
    }
  },
  mounted() {
    this.totalPrice = this.getMyPrice(this.items)
    this.totalQTY = this.getMyQuantities(this.items)
  },
  methods: {
    getMyPrice: arr => {
      return arr.reduce((all, item) => {
        return (all += item.price)
      }, 0)
    },
    getMyQuantities: arr => {
      return arr.reduce((all, item) => {
        return (all += item.qty)
      }, 0)
    }
  },
  watch: {
    items() {
      this.totalPrice = this.getMyPrice(this.items)
      this.totalQTY = this.getMyQuantities(this.item)
    }
  }
}
</script>

<style></style>
