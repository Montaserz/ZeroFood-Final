<template>
  <div id="Cards">
    <v-card class="mx-auto" max-width="434" tile>
      <v-img height="300px" :src="item.image">
        <v-row
          align="end"
          class="fill-height"
          style="background-color: #0000004d;"
        >
          <v-col class="py-0">
            <v-list-item color="rgba(0, 0, 0, .4)" dark>
              <v-list-item-content>
                <v-list-item-title class="title text-dark"
                  >{{ item.name }} - ${{ item.price }}
                </v-list-item-title>
                <v-list-item-subtitle
                  >Added in
                  {{
                    new Date(item.created_at).toDateString()
                  }}</v-list-item-subtitle
                >
                <v-list-item-subtitle>
                  <v-btn
                    depressed
                    class="theme--light cyan darken-2 w-100 text-white"
                    @click="addToCard(item)"
                    ><b class="white--text">Add to Card 🛒</b></v-btn
                  ></v-list-item-subtitle
                >
              </v-list-item-content>
            </v-list-item>
          </v-col>
        </v-row>
      </v-img>
    </v-card>
  </div>
</template>
<script>
import Toasted from 'vue-toasted'

export default {
  name: 'Cards',
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
      let items = JSON.parse(localStorage.getItem('items')) || []
      let oneItem = items.filter(x => x.id == item.id)
      if (oneItem.length == 0) {
        items.push({ ...item, qty: 1 })
        return localStorage.setItem('items', JSON.stringify(items))
      }
      let arr = []
      for (let i of items) {
        if (i.id == item.id) i.qty = ++i.qty
        arr.push(i)
      }
      localStorage.setItem('items', JSON.stringify(arr))
      this.$toasted.show(`${item.name} Now in your card 🛒!`).goAway(1500)
    }
  }
}
</script>
<style scoped>
.font-15 {
  font-size: 15px !important;
}
</style>
