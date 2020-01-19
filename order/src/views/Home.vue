<template>
  <div id="HomeView">
    <home-component :isOpen="open" />
    <v-row justify="between" class="px-5 my-3" align="center">
      <v-col cols="12">
        <h4
          class="title text-center title my-2 "
          style="font-size:30px !important;margin: 10px 0px !important;color: #00b894 !important;"
        >
          ECO FRIENDLY ZERO WASTE FOOD
        </h4>
      </v-col>
      <v-col xs="6" md="2" v-for="item in items" :key="item.id">
        <home-card-looks :item="item" />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Cards from '../components/Cards'
import HomeComponent from '../components/Home'
import HomeCardLooks from '../components/AnotherCards'
export default {
  name: 'HomeView',
  components: {
    HomeComponent,
    HomeCardLooks,
    Cards
  },
  data() {
    return {
      items: [],
      open: false
    }
  },
  created() {
    this.getItems()
  },
  methods: {
    getItems() {
      this.$axios.get('/meals').then(({ data }) => (this.items = data))
    }
  }
}
</script>

<style></style>
