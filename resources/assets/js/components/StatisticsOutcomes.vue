<template>
    <select id="outcomes-select" class="form-control col-md-2" v-bind:class="{ active: isWithCustomer }">
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
        .get(api + "outcomes")
        .then(response => {
          this.customers = response.data;
          setTimeout(function() {
            $("#outcomes-select").select2();
            $("#outcomes-select").on("change", function(e) {
              app5.$refs.dailystats.isDaily = true;
              app5.$refs.dailystats.isYear = false;
              if (app5.statisticsSelect == 7) {
                app5.$refs.dailystats.isDaily = true;
                app5.$refs.dailystats.isYear = false;
                app5.$refs.dailystats.getMonthFunds(2);
                app5.$refs.chartspie.updateChart(1);
              } else if (app5.statisticsSelect == 8) {
                app5.isWithCustomer = false;
                app5.isWithOutcome = true;
                app5.$refs.dailystats.getYearFunds(2);
                app5.$refs.chartspie.updateChart(1);
              } else if (app5.statisticsSelect == 9) {
                app5.$refs.dailystats.isDaily = false;
                app5.$refs.dailystats.isYear = false;
                app5.$refs.dailystats.getAllYearsFunds(2);
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