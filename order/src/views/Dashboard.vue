<template>
  <div class="dashboard">
    <h1 class="headline">Dashboard</h1>
    <DashboardWidget />
    <v-row>
      <v-col cols="8">
        <v-card flat>
          <v-card-title class="headline"
            >Something goes here idk what</v-card-title
          >
        </v-card>
      </v-col>
      <v-col cols="4">
        <v-card flat>
          <v-card-title class="d-flex justify-space-between">
            <span class="title">Active seassons</span>
            <v-icon large color="purple darken-4 ">mdi-access-point</v-icon>
          </v-card-title>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import DashboardWidget from '@/components/DashboardWidget'
export default {
  components: {
    DashboardWidget
  }
}
</script>
