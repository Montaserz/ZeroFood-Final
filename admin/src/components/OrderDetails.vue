<template>
  <div id="OrderDetailsView">
    <v-row justify="center">
      <v-col cols="12" class="my-4"
        ><h3 class="text-center" style="color: #00b894;">
          Order Details
        </h3></v-col
      >
      <v-col cols="8">
        <v-card>
          <v-simple-table>
            <thead>
              <th v-for="head in headers" :key="head" class="text-left">
                {{ head }}
              </th>
            </thead>
            <tbody class="py-4 my-3">
              <tr class="py-4 my-3" v-for="(item, index) in items" :key="index">
                <td>{{ index + 1 }}</td>
                <td class="text-left">
                  {{ item.name }}
                </td>
                <td>{{ item.total }}</td>
                <td>{{ item.info }}</td>
                <td>#{{ item.id }}</td>
                <td>{{ item.status }}</td>
              </tr>
            </tbody>
          </v-simple-table>
        </v-card></v-col
      >
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'OrderDetailsView',
  data() {
    return {
      headers: [
        '#',
        'Meal Name',
        'Price',
        'Meal Description',
        'OrderId',
        'Status'
      ],
      items: []
    }
  },
  async created() {
    await this.getMyOldItems()
    console.log({ items: this.items })
  },
  methods: {
    async getMyOldItems() {
      let { data } = await this.$axios.get('/user/orders')
      this.items = data
    },
    async deleteOrder(item) {
      this.$axios
        .post(`user/orders/delete/${item.id}`)
        .then(({ data }) => console.log({ data }))
    }
  },
  watch: {}
}
</script>

<style></style>
