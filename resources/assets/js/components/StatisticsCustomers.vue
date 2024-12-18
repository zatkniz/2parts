<template>
  <select
    id="customers-select"
    class="form-control col-md-2"
    v-bind:class="{ active: isWithCustomer }"
  >
    <option></option>
    <option v-for="customer in customers" :value="customer.id">{{customer.id}} - {{customer.name}}</option>
  </select>
</template>
<script>
export default {
  data() {
    return {
      count: 0,
      api: api,
      customers: [],
      isWithCustomer: false
    };
  },

  methods: {
    getCustomers() {
      axios
        .get(api + "all-customers")
        .then(response => {
          this.customers = response.data;
          setTimeout(function() {
            $("#customers-select").select2();
            $("#customers-select").on("change", function(e) {
              if (app5.statisticsSelect != 5) {
                app5.$refs.dailystats.isDaily = true;
                app5.$refs.dailystats.isYear = false;
              }
              if (app5.statisticsSelect == 4) {
                app5.$refs.dailystats.getMonthFunds(1);
                app5.$refs.chartspie.updateChart(1);
              } else if (app5.statisticsSelect == 5) {
                app5.$refs.dailystats.getYearFunds(1);
                app5.$refs.chartspie.updateChart(1);
              } else if (app5.statisticsSelect == 6) {
                app5.$refs.dailystats.getAllYearsFunds(1);
                app5.$refs.chartspie.updateChart(1);
              }
            });
          }, 80);
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  created() {},

  mounted() {
    this.getCustomers();
  }
};
</script>
<style>
span.select2.select2-container.select2-container--bootstrap {
  margin-top: 25px;
}
</style>