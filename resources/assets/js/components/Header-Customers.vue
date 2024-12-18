<template>
    <select id="customers-select-header" class="form-control col-md-2" v-bind:class="{ active: isWithCustomer }">
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
            $("#customers-select-header").select2();
            $("#customers-select-header").on("change", function(e) {
                var selected = $('#customers-select-header').val();
              window.open(
                '/single-customer/' + selected,
                "_blank"
              );
              $('#customers-select-header').val('');
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
  margin-top: 8px;
}
</style>