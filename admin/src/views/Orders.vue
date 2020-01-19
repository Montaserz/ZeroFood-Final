<template>
  <div id="ORDERS" class="px-10 mt-10">
    <v-data-table
      :headers="headers"
      :items="orders"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Orders Views</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.action="{ item }">
        <v-icon small class="mr-2" @click="editItem(item)">
          mdi-check
        </v-icon>
        <v-icon small @click="deleteItem(item)">
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">Reset</v-btn>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data: () => ({
    dialog: false,
    headers: [
      {
        text: '#',
        align: 'left',
        sortable: false,
        value: 'id'
      },
      {
        text: 'Name',
        align: 'left',
        sortable: false,
        value: 'name'
      },
      { text: 'useremail', value: 'email' },
      { text: 'price', value: 'total' },
      { text: 'Status', value: 'status' },
      { text: 'Actions', value: 'action', sortable: false }
    ],
    orders: [],
    editedIndex: -1,
    editedItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
    }
  },

  watch: {
    dialog(val) {
      val || this.close()
    }
  },

  created() {
    this.initialize()
  },

  methods: {
    initialize() {
      this.$axios.get('/admin/orders').then(res => (this.orders = res.data))
    },

    editItem(item) {
      console.log({ item })
      const index = this.orders.indexOf(item)
      item.status = 'accepted'
      this.$axios.put(`/admin/orders/${item.id}`, { status: 'accepted' })
      confirm('Are you sure you want to accept this order?') &&
        Object.assign(this.orders[this.editedIndex], item)
    },

    deleteItem(item) {
      const index = this.orders.indexOf(item)
      this.$axios.get(`/user/orders/delete/${item.id}`)
      confirm('Are you sure you want to delete this delete?') &&
        this.orders.splice(index, 1)
    },

    close() {
      this.dialog = false
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      }, 300)
    },

    save() {
      if (this.editedIndex > -1) {
        this.$axios.put(`/orders/update/${this.editedItem.id}`, this.editedItem)

        Object.assign(this.orders[this.editedIndex], this.editedItem)
      } else {
        this.$axios.post('/orders/store', this.editedItem)
        this.orders.push(this.editedItem)
      }
      this.close()
    }
  }
}
</script>
