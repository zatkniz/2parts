
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.moment =  require('moment');

import BootstrapVue from 'bootstrap-vue';
import VModal from 'vue-js-modal';
// import 'bootstrap-vue/dist/bootstrap-vue.css';
// import 'bootstrap/dist/css/bootstrap.css';
require('chart.js');
require('hchs-vue-charts');

Vue.use(VueCharts);
Vue.use(BootstrapVue);
Vue.use(VModal);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('orders', require('./components/Orders.vue'));
Vue.component('incomes', require('./components/Incomes.vue'));
Vue.component('offers', require('./components/Offers.vue'));
Vue.component('outcomes', require('./components/Outcomes.vue'));
Vue.component('newmodal', require('./components/Newincome.vue'));
Vue.component('newoutcome', require('./components/Newoutcome.vue'));
Vue.component('newcustomer', require('./components/NewCustomer.vue'));
Vue.component('editcustomer', require('./components/EditCustomer.vue'));
Vue.component('newpart', require('./components/NewPart.vue'));
Vue.component('editpart', require('./components/EditPart.vue'));
Vue.component('editincome', require('./components/Editincome.vue'));
Vue.component('editoutcome', require('./components/EditOutcome.vue'));
Vue.component('deleteincome', require('./components/Deleteincome.vue'));
Vue.component('deleteoutcome', require('./components/Deleteoutcome.vue'));
Vue.component('addnewoutcome', require('./components/Addnewoutcome.vue'));
Vue.component('quickeditoutcome', require('./components/Quickeditoutcome.vue'));
Vue.component('customers', require('./components/Customers.vue'));
Vue.component('balances', require('./components/Balances.vue'));
Vue.component('employees', require('./components/Employees.vue'));
Vue.component('payroll', require('./components/Payroll.vue'));
Vue.component('payrollsingle', require('./components/Payroll-single.vue'));
Vue.component('employee-customers', require('./components/EmployeeCustomers.vue'));
Vue.component('employers-statistics', require('./components/EmployersStatistics.vue'));
Vue.component('employers-statistics-bars', require('./components/EmployersStatisticsBars.vue'));
Vue.component('employers-statistics-bars-monthly', require('./components/EmployersStatisticsBarsMonthly.vue'));
Vue.component('editpayroll', require('./components/Editpayroll.vue'));
Vue.component('usersonline', require('./components/Users-online.vue'));
Vue.component('users', require('./components/Users-list.vue'));
Vue.component('usersnotifications', require('./components/Users-notifications.vue'));
Vue.component('province', require('./components/Province.vue'));
Vue.component('duties', require('./components/Duties.vue'));
Vue.component('newduty', require('./components/New-duty.vue'));
Vue.component('completeduty', require('./components/Complete-duty.vue'));
Vue.component('dutyonbar', require('./components/Duty-on-bar.vue'));
Vue.component('allowance', require('./components/Allowance.vue'));
Vue.component('newallowance', require('./components/New-allowance.vue'));
Vue.component('deleteallowance', require('./components/Delete-allowance.vue'));
Vue.component('dailystatistics', require('./components/Daily-statistics.vue'));
Vue.component('chartspie', require('./components/Charts-pie.vue'));
Vue.component('chartsbar', require('./components/Charts-bar.vue'));
Vue.component('statisticscustomers', require('./components/StatisticsCustomers.vue'));
Vue.component('statisticsoutcome', require('./components/StatisticsOutcomes.vue'));
Vue.component('headercustomers', require('./components/Header-Customers.vue'));
Vue.component('mail', require('./components/mail.vue'));
Vue.component('weeklycustomers', require('./components/Print-weekly-customers.vue'));

window.bus = new Vue();
window.app5 = new Vue({
    el: '#app5',
    created(){
        setTimeout(function(){$('#delivery-select-customer').select2()},100)
    },
    data: {
        Table: '',
        TableOutfunds: '',
        testPosts: {},
        allCustomers: {},
        deliveries: {},
        allParts: {},
        customers: [],
        sumaries: [],
        funds: [],
        labels: [],
        barincomes: [],
        barpayments: [],
        baroutfunds: [],
        mylabels: ['happy', 'myhappy', 'hello'],
        mydata: [100, 40, 60],
        outfunds: [],
        addedCustomer: '',
        statisticsSelect: '1',
        myChart: '',
        myBar: '',
        isActive: false,
        timeChecked: false,
        dailyFunds: '',
        dailyOutFunds: '',
        sellers: [],
        dateFrom: '',
        dateTo: '',
        result: typeof result !== 'undefined' ? result : '',
        stats: typeof stats !== 'undefined' ? stats : '',
        funds: typeof funds !== 'undefined' ? funds : '',
        outfund: typeof outfund !== 'undefined' ? outfund : '',
        summaries: typeof summaries !== 'undefined' ? summaries : '',
        employees: typeof employees !== 'undefined' ? employees : '',
        hasBalances: typeof hasBalances !== 'undefined' ? hasBalances : '',
        employee: typeof employee !== 'undefined' ? employee : {
            id: '',
            name: '',
            surname: '',
            telephone: '',
            telephone2: '',
            address: '',
            email: '',
            bank_account: '',
            afm: '',
            amka: '',
            position: '',
            hiring_date: '',
            firing_date: '',
        },
        addedOutcome: '',
        countPayroll: 0,
        messageBody: '',
        isfromquery: false,
        isWithCustomer: false,
        isWithOutcome: false,
        newMessage: false,
        showWeeklySchedule: false,
        selectedOutfund: '',
        selectedFund: '',
        selectedPrint: [],
        receiverId: '',
        addedPart: '',
        editFund: '',
        editOutFund: '',
        fundQuery: '',
        authUser: '',
        echoId: '',
        newMessagesArray: [],
        selectedCustomer: 0,
        selectedPart: 0,
        messageData: {
            messageBody: '',
            receiverId: ''
        },
        chats: [],
        printDate: {
            date: ''
        },
        newdata: {
            empno: '',
            month: '',
            year: '',
            systemDefaults: '',
            payrollPeriod: '',
            siteCode: ''
        },
        newUser: {

        },
    },
    created() {
        this.getSellers();
    },
    methods: {
        getSellers: function(){
            axios.get(api + 'get-sellers', this.part)
            .then(res => {
                this.sellers = res.data
            })
            .catch(e => {
                console.log(e)
            })
        },
        openNewincomeModal: function (isOffer) {
            app5.$modal.show('example' , {isOffer: isOffer});
            setTimeout(() => {
                $('select').select2().on('select2:open', function () {
                    $('.select2-dropdown').removeClass('select2-dropdown--above');
                    $('.select2-dropdown').addClass('select2-dropdown--below');
                })
                $('#parts-select').on("change", function (e) {
                    setTimeout(function () {
                        $("#quantity-name").focus()
                    }, 150);
                }).on("select2-close", function () {
                    setTimeout(function () {
                        $("#quantity-name").focus()
                    }, 150);
                }).on("select2:close", function () {
                    setTimeout(function () {
                        $("#quantity-name").focus()
                    }, 150);
                });
            }, 30)
        },
        getYearStatistics: function () {
            if (this.statisticsSelect == 1) {
                app5.isWithCustomer = false;
                app5.isWithOutcome = false;
                app5.$refs.dailystats.isDaily = true;
                app5.$refs.dailystats.isYear = false;
                this.$refs.dailystats.getMonthFunds();
                app5.$refs.chartspie.updateChart();
                return;
            } else if (this.statisticsSelect == 2) {
                app5.isWithCustomer = false;
                app5.isWithOutcome = false;
                app5.$refs.dailystats.isDaily = false;
                app5.$refs.dailystats.isYear = true;
                this.$refs.dailystats.getYearFunds();
                app5.$refs.chartspie.updateYear();
                return;
            } else if (this.statisticsSelect == 3) {
                app5.isWithCustomer = false;
                app5.isWithOutcome = false;
                app5.$refs.dailystats.isDaily = false;
                app5.$refs.dailystats.isYear = false;
                this.$refs.dailystats.getAllYearsFunds();
                app5.$refs.chartspie.updateAll();
                return;
            } else if (this.statisticsSelect == 4 || this.statisticsSelect == 5 || this.statisticsSelect == 6) {
                app5.isWithCustomer = true;
                app5.isWithOutcome = false;
                $("#outcomes-select").select2('destroy')
                if ($('#customers-select').val() != '') {
                    if (app5.statisticsSelect == 4) {
                        app5.isWithCustomer = true;
                        app5.isWithOutcome = false;
                        app5.$refs.dailystats.isDaily = true;
                        app5.$refs.dailystats.isYear = false;
                        app5.$refs.dailystats.getMonthFunds(1);
                        app5.$refs.chartspie.updateChart(1);
                    } else if (app5.statisticsSelect == 5) {
                        app5.isWithCustomer = true;
                        app5.isWithOutcome = false;
                        app5.$refs.dailystats.isDaily = false;
                        app5.$refs.dailystats.isYear = true;
                        app5.$refs.dailystats.getYearFunds(1);
                        app5.$refs.chartspie.updateChart(1);
                    } else if (app5.statisticsSelect == 6) {
                        app5.isWithCustomer = true;
                        app5.isWithOutcome = false;
                        app5.$refs.dailystats.isDaily = false;
                        app5.$refs.dailystats.isYear = false;
                        app5.$refs.dailystats.getAllYearsFunds(1);
                        app5.$refs.chartspie.updateChart(1);
                    }
                }
                return;
            } else if (this.statisticsSelect == 7 || this.statisticsSelect == 8 || this.statisticsSelect == 9) {
                app5.isWithCustomer = false;
                app5.isWithOutcome = true;
                $("#customers-select").select2('destroy')
                if ($('#outcomes-select').val() != '') {
                    if (app5.statisticsSelect == 7) {
                        app5.isWithCustomer = false;
                        app5.isWithOutcome = true;
                        app5.$refs.dailystats.isDaily = true;
                        app5.$refs.dailystats.isYear = false;
                        app5.$refs.dailystats.getMonthFunds(2);
                        app5.$refs.chartspie.updateChart(1);
                    } else if (app5.statisticsSelect == 8) {
                        app5.isWithCustomer = false;
                        app5.isWithOutcome = true;
                        app5.$refs.dailystats.isDaily = false;
                        app5.$refs.dailystats.isYear = true;
                        app5.$refs.dailystats.getYearFunds(2);
                        app5.$refs.chartspie.updateChart(1);
                    } else if (app5.statisticsSelect == 9) {
                        app5.isWithCustomer = false;
                        app5.isWithOutcome = true;
                        app5.$refs.dailystats.isDaily = false;
                        app5.$refs.dailystats.isYear = false;
                        app5.$refs.dailystats.getAllYearsFunds(2);
                        app5.$refs.chartspie.updateChart(1);
                    }
                }
                return;
            }
            app5.$refs.dailystats.isDaily = true;
            app5.$refs.dailystats.isYear = false;
        },
        moment: function (time) {
            moment.locale('el');
            return moment(time).format('D MMMM YYYY, h:mm:ss a');
            this.timeChecked = true;
        },
        setMessageTime: function (time) {
            return moment(time).format('h:mm a');
        },
        addNewUser: function (time) {
            console.log('s');
            axios.post(api + 'register-new-user', this.newUser)
                .then(response => {
                    window.location.href = api + 'users'
                })
                .catch(e => {
                    console.log(e)
                })
        },
        sendMessage: function () {
            this.messageData = {
                messageBody: this.messageBody,
                receiverId: this.receiverId
            };
            axios.post(api + 'send-message/' + this.authUser, this.messageData)
                .then(response => {
                    this.messageBody = '';
                    axios.get(api + 'chat-logs/' + app5.authUser + '/' + app5.receiverId)
                        .then(response => {
                            app5.chats = response.data;
                            setTimeout(function () {
                                $('.page-quick-sidebar-chat-user-messages').scrollTop(10000);
                            }, 50);
                        })
                        .catch(e => {
                            console.log(e);
                        })
                })
                .catch(e => {
                    console.log(e)
                })
        },
        printReport: function () {
            if ($('#prints-select').val() == '1') {
                this.showWeeklySchedule = false;
                this.printWeeklySchedule();
            } else if ($('#prints-select').val() == '2') {
                this.showWeeklySchedule = false;
                this.printMonthlyCustomersList();
            } else if ($('#prints-select').val() == '3') {
                this.showWeeklySchedule = false;
                this.printMonthlyCustomersListWithPrice();
            } else if ($('#prints-select').val() == '4') {
                this.showWeeklySchedule = true;
            } else {
                return
            }
        },
        printWeeklySchedule() {
            axios.get(api + 'weekly-print')
                .then(response => {
                    this.printWeekly(response.data);
                })
                .catch(e => {
                    console.log(e)
                })
        },
        printMonthlyCustomersList() {
            this.printDate.date = $('input#printDate').val();
            axios.post(api + 'monthly-customers', this.printDate)
                .then(response => {
                    this.printMonthlyCustomers(response.data);
                })
                .catch(e => {
                    console.log(e)
                })
        },
        printMonthlyCustomersListWithPrice() {
            this.printDate.date = $('input#printDate').val();
            axios.post(api + 'monthly-customers', this.printDate)
                .then(response => {
                    console.log($('input#printDate').val());
                    this.printMonthlyCustomersWithPrice(response.data);
                })
                .catch(e => {
                    console.log(e)
                })
        },
        printMonthlyCustomersWithPrice: function (data) {
            var head = [{ text: 'Πελάτης', alignment: 'center' }, { text: 'Τζίρος', alignment: 'center' }, { text: 'Παρατηρήσεις', alignment: 'center' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            var totalPrice = 0;
            for (var i = 0; i < data.length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                rowThird[0] = data[i].name;
                rowThird[1] = { text: data[i].print_customersfunds.price.toFixed(2) + '€', alignment: 'center' };
                rowThird[2] = '';
                totalPrice = totalPrice + data[i].print_customersfunds.price;
                bdy.push(rowThird);
            }
            var rowFirst = new Array();
            var rowSecond = new Array();
            var rowThird = new Array();
            rowThird[0] = 'Σύνολο:';
            rowThird[1] = { text: totalPrice.toFixed(2) + '€', alignment: 'center' };
            rowThird[2] = '';
            bdy.push(rowThird);
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            var momentMonth = $('input#printDate').val() != '' ? '01/' + $('input#printDate').val() : today;
            this.docDefinition = {
                content: [
                    {
                        text: 'Μήνας: ' + moment(momentMonth, 'DD/MM/YYYY').locale('el').format('MMMM'),
                    },
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [200, 50, 297],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        printMonthlyCustomers: function (data) {
            var head = [{ text: 'Πελάτης', alignment: 'center' }, { text: 'Παρατηρήσεις', alignment: 'center' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            for (var i = 0; i < data.length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                rowThird[0] = data[i].name;
                rowThird[1] = '';
                bdy.push(rowThird);
            }
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            var momentMonth = $('input#printDate').val() != '' ? '01/' + $('input#printDate').val() : today;
            this.docDefinition = {
                content: [
                    {
                        text: 'Μήνας: ' + moment(momentMonth, 'DD/MM/YYYY').locale('el').format('MMMM'),
                    },
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [200, 355],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        printWeekly: function (data) {
            var head = [{ text: 'Πελάτης', alignment: 'center' }, { text: 'Δευτέρα', alignment: 'center' }, { text: 'Τρίτη', alignment: 'center' }, { text: 'Τετάρτη', alignment: 'center' }, { text: 'Πέμπτη', alignment: 'center' }, { text: 'Παρασκευή', alignment: 'center' }, { text: 'Σάββατο', alignment: 'center' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            for (var i = 0; i < data.length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                rowThird[0] = data[i].name;
                rowThird[1] = '';
                rowThird[2] = '';
                rowThird[3] = '';
                rowThird[4] = '';
                rowThird[5] = '';
                rowThird[6] = '';
                bdy.push(rowThird);
            }
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            this.docDefinition = {
                content: [
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [200, 92, 92, 92, 92, 92, 92],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageOrientation: 'landscape',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        printCustomerhistory: function () {
            var head = [{ text: 'Ημερομηνία', alignment: 'center' }, { text: 'Ανταλλακτικά', alignment: 'center' }, { text: 'Αυτοκίνητο', alignment: 'center' }, { text: 'Παραγγελία', alignment: 'center' }, { text: 'Πληρωμή', alignment: 'center' }, { text: 'Κωδικός Παραγγελίας', alignment: 'center' }, { text: 'Υπόλοιπο', alignment: 'center' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            for (var i = 0; i < app5.funds.length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                var creditBody = '';
                if (i > 0) {
                    app5.funds[i].customer.balance.balance = app5.funds[i - 1].customer.balance.balance - app5.funds[i - 1].cost + app5.funds[i - 1].payment

                    if(app5.funds[i - 1].credit){
                        app5.funds[i].customer.balance.balance = app5.funds[i].customer.balance.balance + app5.funds[i - 1].credit
                    }
                }

                if(app5.funds[i].credit){
                    creditBody = '( Ποσό πιστωτικού: ' + app5.funds[i].credit + '€ )';
                }
                
                rowThird[0] = moment(app5.funds[i].created_at).locale('el').format('D MMMM YYYY, h:mm a');
                rowThird[1] = app5.funds[i].body + ' ' + creditBody;
                rowThird[2] = app5.funds[i].cars;
                rowThird[3] = { alignment: 'center', text: app5.funds[i].cost + '€' };
                rowThird[4] = { alignment: 'center', text: app5.funds[i].payment + '€' };
                rowThird[5] = app5.funds[i].fund_code;
                rowThird[6] = { alignment: 'center', text: app5.funds[i].customer.balance.balance.toFixed(2) + '€' };
                bdy.push(rowThird);
            }
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            this.docDefinition = {
                content: [
                    {
                        margin: [340, 0, 0, 0],
                        width: 170,
                        image: 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMdaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzEzOCA3OS4xNTk4MjQsIDIwMTYvMDkvMTQtMDE6MDk6MDEgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkE3OEQyMzZCOTYzQTExRTdBRjgxQkJDOURENDRCQ0NEIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkE3OEQyMzZBOTYzQTExRTdBRjgxQkJDOURENDRCQ0NEIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE3IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0iQkVDMjY5Q0EwNkI2QjAwNUQwODYwNThCMzI5OEQ3RDUiIHN0UmVmOmRvY3VtZW50SUQ9IkJFQzI2OUNBMDZCNkIwMDVEMDg2MDU4QjMyOThEN0Q1Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/+0ASFBob3Rvc2hvcCAzLjAAOEJJTQQEAAAAAAAPHAFaAAMbJUccAgAAAgACADhCSU0EJQAA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'
                    },
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        text: 'Πελάτης: ' + app5.funds[0].customer.name,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [150, 265, 92, 50, 50, 92, 60],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageOrientation: 'landscape',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        quickEditPayment: function (fund, index) {
            if (fund) {
                app5.selectedFund = fund;
                $('td#editable' + index).html(' <input id="edit-input' + index + '" type="text" value="' + fund.payment + '" class="form-control" style="width:85%" placeholder="Ποσό" onkeypress="app5.quickSaveFund(event,' + index + ')">€');
                setTimeout(function () {
                    $('td#editable' + index + ' input').focus();
                }, 50);
            }
        },
        unFocus: function (fund, index) {
            if (fund) {
                $('td#editable' + index).html(fund.payment + '€');
            }
        },
        checkIfnull: function (forCheck) {
            if (forCheck) {
                return forCheck.count;
            }
            return 0;
        },
        updatePayrollData: function (forCheck) {
            console.log(forCheck);
        },
        updateUser: function (user) {
            axios.post(api + 'update-user/' + user.id, user)
                .then(response => {
                    location.reload();
                })
                .catch(e => {
                    console.log(e)
                })
        },
        checkIfnullPrice: function (forCheck) {
            if (forCheck) {
                return forCheck.price;
            }
            return 0;
        },
        openNewOutcomeModal: function () {
            app5.$modal.show('newoutcome');
            setTimeout(() => {
                $('select').select2().on('select2:open', function () {
                    $('.select2-dropdown').removeClass('select2-dropdown--above');
                    $('.select2-dropdown').addClass('select2-dropdown--below');
                }).on("change", function (e) {
                    setTimeout(function () {
                        $("#car-name").focus()
                    }, 30);
                }).on("select2-close", function () {
                    setTimeout(function () {
                        $("#car-name").focus()
                    }, 30);
                }).on("select2:close", function () {
                    setTimeout(function () {
                        $("#car-name").focus()
                    }, 30);
                });
            }, 30)
        },
        closeNewincomeModal: function () {
            app5.$modal.show('example');
        },
        editPayrollModal: function (payroll, id, isSingle) {
            app5.$modal.show('payroll', { employee: payroll[id] });
        },
        closeNewincomeModal: function () {
            app5.$modal.show('example');
        },
        searchFund: function () {
            window.location.href = api + 'single-fund/' + this.fundQuery;
        },
        editCustomer: function (customer) {
            $('select').select2('close');
            app5.$modal.show('editcustomer', { customer: app5.selectedCustomer });
        },
        editPart: function (customer) {
            $('select').select2('close');
            app5.$modal.show('editpart', { customer: app5.selectedCustomer });
        },
        editOutcome: function (id) {
            $('select').select2('close');            
            app5.$modal.show('quickeditoutcome', { outcome: app5.selectedOutfund });
        },
        greekSymbol: function (str) {
            if (str.length == 0) {
                return "";
            }
            var english = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
            var greek = ['α', 'β', 'γ', 'δ', 'ε', 'φ', 'γ', 'η', 'ι', 'ξ', 'κ', 'λ', 'μ', 'ν', 'ο', 'π', ' ', 'ρ', 'σ', 'τ', 'υ', 'ω', 'σ', 'χ', 'υ', 'ζ'];
            if (greek.indexOf(str) != -1) {
                return str;
            }
            return greek[english.indexOf(str)];
        },
        saveSingleCustomer: function (customer) {
            customer.employee_id = $('#delivery-select-customer').val();
            axios.post(api + 'save-single-customer/' + customer.id, customer)
                .then(response => {
                    location.reload();
                })
                .catch(e => {
                    console.log(e)
                })
        },
        saveNewEmployee: function (employee) {
            employee.hiring_date = $('input#hiring-date').val();
            employee.firing_date = $('input#firing-date').val();
            location.href.indexOf('new-employee') > 0 ? employee.active = 1 : 0;
            if (employee.name == '') {
                toastr.warning('Δεν έχει οριστεί όνομα υπαλλήλου');
                return;
            }
            axios.post(api + 'save-new-employee', employee)
                .then(response => {
                    window.location.href = api + 'employees';
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
        deactivateSingleCustomer: function (customer) {
            customer.active == 0 ? customer.active = 1 : customer.active = 0;
            axios.post(api + 'save-single-customer/' + customer.id, customer)
                .then(response => {
                    location.reload();
                })
                .catch(e => {
                    console.log(e)
                })
        },
        quickSaveFund: function (e, index) {
            if (e.keyCode === 13) {
                app5.selectedFund.payment = parseFloat($('#quicksavevalue').val().replace(',', '.')) != '' ? parseFloat($('#quicksavevalue').val().replace(',', '.')) : app5.selectedFund.payment;
                axios.post(api + 'update-fund/' + index, app5.selectedFund)
                    .then(response => {
                        app5.$refs.incomes.resetFunds()
                        // this.part = {
                        //     name: '',
                        // };
                        // this.$modal.hide('editincome');
                        // $.unblockUI();
                        $('#editable' + index).html(app5.selectedFund.payment + '€')
                    })
                    .catch(e => {
                        console.log(e)
                    })
            }
        },
        findPastFund: function () {
            var dateFrom = $('#dateFrom').val().split('/');
            var dateTo = $('#dateTo').val().split('/');
            if ($('#dateFrom').val() == '') {
                toastr.warning('Δεν έχετε ορίσει αρχική ημερομηνία');
                return;
            }
            var dayFromValid = new Date(dateFrom[2], dateFrom[1], dateFrom[0]);
            var dayToValid = new Date(dateTo[2], dateTo[1], dateTo[0]);
            if (dayFromValid.valueOf() > dayToValid.valueOf()) {
                toastr.warning('Η τελική ημερομηνία δεν μπορεί να είναι μικρότερη απο την αρχική.');
                return;
            }
            if ($('#dateTo').val() == '') {
                dateTo = dateFrom;
            }
            window.location.href = api + 'past-funds/from=' + dateFrom[2] + '-' + dateFrom[1] + '-' + dateFrom[0] + '&to=' + moment(dateTo , 'DD/MM/YYYY').add(1,'day').format('YYYY-MM-DD');
        },
        findRangedCustomer: function (id) {
            var dateFrom = $('#dateFrom').val().split('/');
            var dateTo = $('#dateTo').val().split('/');
            if ($('#dateFrom').val() == '') {
                toastr.warning('Δεν έχετε ορίσει αρχική ημερομηνία');
                return;
            }
            var dayFromValid = new Date(dateFrom[2], dateFrom[1], dateFrom[0]);
            var dayToValid = new Date(dateTo[2], dateTo[1], dateTo[0]);
            if (dayFromValid.valueOf() > dayToValid.valueOf()) {
                toastr.warning('Η τελική ημερομηνία δεν μπορεί να είναι μικρότερη απο την αρχική.');
                return;
            }
            if ($('#dateTo').val() == '') {
                dateTo = dateFrom;
            }
            window.location.href = api + '/single-customer/' + id + '/from=' + dateFrom[2] + '-' + dateFrom[1] + '-' + dateFrom[0] + '&to=' + moment(dateTo , 'DD/MM/YYYY').add(1,'day').format('YYYY-MM-DD');
        },
        editOutcomeModal: function (outfund, id) {
            app5.$modal.show('editoutcome', { outcome: outfund });
        },
        editincomeModal: function (fund) {
            app5.$modal.show('editincome', { fund: fund });
        },
        printAllBalances: function (data) {
            var head = [{ text: 'Πελάτης' }, { text: 'Υπόλοιπο' }, { text: 'Πληρωμή' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            for (var i = 0; i < data.length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                // if (fund[id].cars.split(',')[i] != fund[id].cars.split(',')[i - 1]) {
                //     rowThird[0] = fund[id].cars.split(',')[i];
                // } else {
                //     rowThird[0] = '';
                // }
                rowThird[0] = data[i].name;
                rowThird[1] = { alignment: 'center', text: data[i].balance.balance.toFixed(2) + '€' };
                sumBalance += parseFloat(data[i].balance.balance);
                rowThird[2] = { alignment: 'right', text: '€' };
                // rowThird[1] = fund[id].body.split(',')[i];
                // rowThird[2] = { alignment: 'center', text: fund[id].price.split('%')[i] + '€' };
                bdy.push(rowThird);
            }
            var sum = [{ text: 'Σύνολο' }, { alignment: 'right', text: sumBalance.toFixed(2) + '€' }, { text: '' }];
            bdy.push(sum);
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            this.docDefinition = {
                content: [
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [200, 50, 50],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        printSelectedBalances: function (data) {
            var head = [{ text: 'Πελάτης' }, { text: 'Υπόλοιπο' }, { text: 'Πληρωμή' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            for (var i = 0; i < data.length; i++) {
                if (data[i]) {
                    var rowFirst = new Array();
                    var rowSecond = new Array();
                    var rowThird = new Array();
                    // if (fund[id].cars.split(',')[i] != fund[id].cars.split(',')[i - 1]) {
                    //     rowThird[0] = fund[id].cars.split(',')[i];
                    // } else {
                    //     rowThird[0] = '';
                    // }
                    rowThird[0] = data[i].name;
                    rowThird[1] = { alignment: 'center', text: data[i].balance.balance.toFixed(2) + '€' };
                    sumBalance += parseFloat(data[i].balance.balance);
                    rowThird[2] = { alignment: 'right', text: '€' };
                    // rowThird[1] = fund[id].body.split(',')[i];
                    // rowThird[2] = { alignment: 'center', text: fund[id].price.split('%')[i] + '€' };
                    bdy.push(rowThird);
                }
            }
            var sum = [{ text: 'Σύνολο' }, { alignment: 'right', text: sumBalance.toFixed(2) + '€' }, { text: '' }];
            bdy.push(sum);
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            this.docDefinition = {
                content: [
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [50, 50, 50],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        printBalances: function (data) {
            var head = [{ text: 'Πελάτης' }, { text: 'Υπόλοιπο' }, { text: 'Πληρωμή' }];
            var bdy = [];
            bdy.push(head);
            var sumBalance = 0;
            for (var i = 0; i < app5.hasBalances.length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                // if (fund[id].cars.split(',')[i] != fund[id].cars.split(',')[i - 1]) {
                //     rowThird[0] = fund[id].cars.split(',')[i];
                // } else {
                //     rowThird[0] = '';
                // }
                rowThird[0] = app5.hasBalances[i].name;
                rowThird[1] = { alignment: 'center', text: app5.hasBalances[i].balance.balance.toFixed(2) + '€' };
                sumBalance += parseFloat(app5.hasBalances[i].balance.balance);
                rowThird[2] = { alignment: 'right', text: '€' };
                // rowThird[1] = fund[id].body.split(',')[i];
                // rowThird[2] = { alignment: 'center', text: fund[id].price.split('%')[i] + '€' };
                bdy.push(rowThird);
            }
            var sum = [{ text: 'Σύνολο' }, { alignment: 'right', text: sumBalance.toFixed(2) + '€' }, { text: '' }];
            var count = [{ text: 'Πελάτες' }, { alignment: 'center', text: app5.hasBalances.length }, { text: '' }];
            bdy.push(count);
            bdy.push(sum);
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            this.docDefinition = {
                content: [
                    {
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [200, 50, 50],
                            headerRows: 1,
                            alignment: 'center',
                            body: bdy
                        }
                    },
                ],
                styles: {
                    tableExample: {
                        margin: [0, 10, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
            };
            pdfMake.createPdf(this.docDefinition).open();
        },
        createPdf: function (fund, id) {  
            console.log(fund);
                      
            var head = [{ fontSize: 10, alignment: 'center', text: 'Αυτ/το' }, { fontSize: 10, alignment: 'center', text: 'Τεμ' }, { fontSize: 10, alignment: 'center', text: 'Ανταλλακτικό' }, { fontSize: 10, alignment: 'center', text: 'Τιμή' }];
            var bdy = [];
            bdy.push(head);
            for (var i = 0; i < fund.body.split(',').length; i++) {
                var rowFirst = new Array();
                var rowSecond = new Array();
                var rowThird = new Array();
                if (fund.cars.split(',')[i] != fund.cars.split(',')[i - 1]) {
                    rowThird[0] = { fontSize: 8, text: fund.cars.split(',')[i] };
                } else {
                    rowThird[0] = '';
                }
                if (fund.parts_codes != null && fund.parts_codes.split('%')[i] != '' && fund.parts_codes.split('%')[i] != ' ') {
                    var fundPartsCode = ' (' + fund.parts_codes.split('%')[i] + ')'
                } else {
                    var fundPartsCode = '';
                }
                rowThird[1] = { fontSize: 8, alignment: 'center', text: fund.body.indexOf('*') > -1 ? fund.body.split(',')[i].split('*')[0] : '' };
                rowThird[2] = { fontSize: 8, text: fund.body.indexOf('*') > -1 ? fund.body.split(',')[i].split('*')[1] + fundPartsCode : fund.body.split(',')[i] + 'duo' };
                rowThird[3] = { fontSize: 8, alignment: 'center', text: fund.body.indexOf('*') > -1 ? parseFloat(fund.body.split(',')[i].split('*')[0]).toFixed(2) * parseFloat(fund.price.split('%')[i]).toFixed(2) : fund.price.split('%')[i] + '€' };
                bdy.push(rowThird);
            }
            // var space = [{ text: '' }, { text: '' }, { text: '' }];
            // bdy.push(space);
            // var cost = [];
            // bdy.push(cost);
            // var payment = [];
            // bdy.push(payment);
            // var total = [];
            // bdy.push(total);
            // var total = [{ text: 'Υπόλοιπο Πελάτη:' }, { text: '' }, { alignment: 'center', style: 'netpayable', text: fund[id].customer.balance.balance - fund[id].total + '€' }];
            // bdy.push(total);
            // var newtotal = [];
            // bdy.push(newtotal);
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '/' + mm + '/' + yyyy;
            var fund_date = fund.created_at.split('-');
            var theDate = fund_date[2].substr(0, 2) + '/' + fund_date[1] + '/' + fund_date[0];
            this.docDefinition = {
                content: [
                    {
                        margin: [10, 0, 0, 0],
                        width: 170,
                        image: 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMdaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzEzOCA3OS4xNTk4MjQsIDIwMTYvMDkvMTQtMDE6MDk6MDEgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkE3OEQyMzZCOTYzQTExRTdBRjgxQkJDOURENDRCQ0NEIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkE3OEQyMzZBOTYzQTExRTdBRjgxQkJDOURENDRCQ0NEIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE3IFdpbmRvd3MiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0iQkVDMjY5Q0EwNkI2QjAwNUQwODYwNThCMzI5OEQ3RDUiIHN0UmVmOmRvY3VtZW50SUQ9IkJFQzI2OUNBMDZCNkIwMDVEMDg2MDU4QjMyOThEN0Q1Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/+0ASFBob3Rvc2hvcCAzLjAAOEJJTQQEAAAAAAAPHAFaAAMbJUccAgAAAgACADhCSU0EJQAA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'
                    },
                    {
                        margin: [0, 30, 0, 0],
                        text: 'Προτιμολόγιο - Προσφορά',
                        fontSize: 15,
                    },
                    {
                        margin: [0, 10, 0, 0],
                        fontSize: 10,
                        text: 'Επωνυμία: ' + fund.customer.name,
                    },
                    {
                        fontSize: 10,
                        text: 'Κωδικός Παραγγελίας: ' + fund.fund_code,
                    },
                    {
                        fontSize: 10,
                        text: 'Ημερομηνία Έκδοσης: ' + today,
                    },
                    {
                        fontSize: 10,
                        text: 'Ημερομηνία Παραγγελίας: ' + theDate,
                    },
                    {
                        style: 'tableExample',
                        table: {
                            widths: [40, 20, 70, 24],
                            body: bdy
                        }
                    },
                    {
                        fontSize: 11,
                        margin: [0, 30, 0, 0],
                        text: 'Σύνολο Παραγγελίας: ' + fund.cost + '€',
                    },
                    {
                        fontSize: 11,
                        text: 'Πληρωμή: ' + fund.payment + '€',
                    },
                    {
                        fontSize: 11,
                        text: 'Υπόλοιπο Παραγγελίας: ' + fund.total + '€',
                    },
                    {
                        fontSize: 11,
                        text: 'Υπόλοιπο Πελάτη: ' + (fund.customer.balance.balance - fund.total).toFixed(2) + '€',
                    },
                    {
                        fontSize: 11,
                        text: 'Νέο Υπόλοιπο Πελάτη: ' + fund.customer.balance.balance + '€',
                    },
                    {
                        margin: [0, 10, 0, 0],
                        fontSize: 7,
                        text: 'Το παρών έγγραφο δεν αποτελεί φορολογική απόδειξη.',
                    },
                    {
                        margin: [0, 5, 0, 0],
                        fontSize: 7,
                        text: 'Όλα τα είδη καλύπτονται αποκλειστικά και μόνο απο την',
                    },
                    {
                        margin: [0, 0, 0, 0],
                        fontSize: 7,
                        text: 'εγγύηση τους όρους και το χρόνο που δίνει το εκάστοτε',
                    },
                    {
                        margin: [0, 0, 0, 0],
                        fontSize: 7,
                        text: 'εργοστάσιο κατασκευής τους και τα οποία δεν δεσμεύουν',
                    },
                    {
                        margin: [0, 0, 0, 0],
                        fontSize: 7,
                        text: 'σε καμία περίπτωση την εταιρία μας.',
                    }
                ],
                styles: {
                    tableExample: {
                        margin: [0, 30, 100, 0],
                        fontSize: 9,
                    },
                    header: {
                        fillColor: "#4276A4",
                        color: '#fff',
                        alignment: 'center'
                    },
                    employee_class: {
                        fillColor: "#ddd",
                    },
                    netpayable: {
                        fillColor: "#d64635",
                        color: '#fff'
                    }
                },
                // pageOrientation: 'landscape',
                pageSize: 'A4',
                pageMargins: [10, 10, 10, 10],
                defaultStyle: {
                    // alignment: 'justify'
                },
                // header: {

                // },
            };
            pdfMake.createPdf(this.docDefinition).print();
        },
        deleteincomeModal: function (fund, id) {
            app5.$modal.show('deleteincome', { fund: fund });
        },
        mailModal: function (fund, id) {
            app5.$modal.show('mail', { fund: fund });
        },
        deleteOutcomeModal: function (outfund, id) {
            app5.$modal.show('deleteoutcome', { outfund: outfund });
        },
        closeNewincomeModal: function () {
            app5.$modal.show('example');
        },
        newDutyModal: function (duty) {
            app5.$modal.show('newduty', { duty: duty });
        },
        newAllowanceModal: function (employee) {
            app5.$modal.show('newallowanace', { employee: employee });
        },
        completeDutyModal: function (duty) {
            app5.$modal.show('completeduty', { duty: duty });
        },
        deleteAllowance: function (duty) {
            app5.$modal.show('deleteallowance', { duty: duty });
        },
        mergeFunds: function (startedCustomer, finishedCustomer) {
            if (startedCustomer.customer.id != finishedCustomer.customer.id) {
                toastr.warning('Ο πελάτης που προπαθείτε να προσθέσετε παραγγελία δεν είναι ίδιος');
                return;
            };
            axios.get(api + 'merge-funds/' + startedCustomer.id + '/' + finishedCustomer.id)
                .then(response => {
                    app5.$refs.incomes.resetFunds()
                })
                .catch(e => {
                    app5.Table.ajax.reload()
                })
        },
        sendMail: function (editFund) {
            axios.post(api + 'send-pdf/' + editFund.id)
                .then(response => {
                    toastr.success('Το mail εστάλει επιτυχώς.');
                })
                .catch(e => {
                    console.log(e)
                })
        },
        dataTable: function (elementId) {        
            setTimeout(function () {
                app5.Table = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
                    },
                    "bPaginate": false,
                    ajax: {
                        'url': api + 'funds',
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    class: 'd',
                    className: 'dname',
                    rowCallback: function (row, data) {
                        if (data.customer.has_overcome_balance) {
                            $(row).addClass('redRow');
                        }
                    },
                    columns: [
                        {
                            data: function (d) {
                                return '<span data-toggle="popover" data-container="body" data-placement="top" data-trigger="hover" title="Υπόλοιπο" data-content="' + d.customer.balance.balance + '€" </span>' + d.customer.name
                            }
                        },
                        { data: 'body' },
                        {
                            data: function (d) {
                                return d.cost + '€'
                            }
                        },
                        {
                            data: function (d) {
                                var isBank = d.isBank ? '  <i class="fa fa-university"></i>' : '';
                                return d.payment + '€' + isBank;
                            },
                        },
                        {
                            data: function (d) {
                                return d.cars
                            }
                        },
                        {
                            data: function (d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.customer.balance.balance + '€'
                            }
                        },
                        { data: 'fund_code' },
                        {
                            data: function (d) {
                                return d.user.name + ' (' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                return d.delivery ? d.delivery.name + ' ' + d.delivery.surname : ''; 
                            }
                        },
                        {
                            data: function (d) {
                                return d.last_user.name + ' (' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                app5.editFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.createPdf( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-print" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.mailModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-danger btn-outline" onclick='app5.deleteincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                </a>`

                            }
                        },
                    ],
                    "initComplete": function (settings, json) {
                        $('[data-toggle="popover"]').popover();
                        $.contextMenu({
                            selector: 'table#sample_1 tbody tr',
                            callback: function (key, options) {
                                var m = "clicked: " + key;
                                window.console && console.log(m) || alert(m);
                            },
                            items: {
                                "new": {
                                    name: "Νέα Παραγγελία",
                                    icon: "fa-plus",
                                    callback: function (itemKey, opt, rootMenu, originalEvent) {
                                        app5.openNewincomeModal()
                                    }
                                },
                                "print": {
                                    name: "Εκτύπωση Παραγγελίας",
                                    icon: "fa-print",
                                    callback: function (itemKey, opt, rootMenu, originalEvent) {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.createPdf( app5.Table.row(this[0]).data())
                                    }
                                },
                                "edit": {
                                    name: "Επεξεργασία Παραγγελίας",
                                    icon: "edit",
                                    callback: function () {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        console.log(app5.Table.row(this[0]).data());
                                        
                                        app5.editincomeModal(app5.Table.row(this[0]).data())
                                    }
                                },
                                "delete": {
                                    name: "Διαγραφή Παραγγελίας",
                                    icon: "delete",
                                    callback: function () {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.deleteincomeModal(app5.Table.row(this[0]).data())
                                    }
                                },
                            }
                        });
                    },
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
                        { text: 'Προσφορά', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal(true) } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        // { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],
                    rowReorder: {
                        selector: 'tr td:nth-child(2)'
                    },
                    keys: true,
                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "columnDefs": [
                        { "width": "6%", "targets": 1 }
                    ],
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
                app5.Table.on('row-reorder', function (e, diff, edit) {
                    var startedCustomer = edit.triggerRow.data();
                    var finishedCustomer = app5.Table.row(diff[1].node).data();
                    app5.mergeFunds(startedCustomer, finishedCustomer)
                });
                $('#sample_1 tbody').on('dblclick', 'tr', function () {
                    var savedData = app5.Table.row(this).nodes()[0].childNodes[3];
                    var data = app5.Table.row(this).nodes()[0].childNodes[3];
                    app5.selectedFund = app5.Table.row(this).data()
                    data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
                    setTimeout(function () {
                        $('#quicksavevalue').focus()
                    }, 50);
                }).on('key-blur', function (e, datatable, cell) {
                    console.log('s');

                    app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
                });
            }, 300);
        },
        dataTableOffers: function (elementId) {
            setTimeout(function () {
                app5.TableOffers = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ εγγραφές",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές",
                        "paginate": {
                            "first":      "Πρώτη",
                            "last":       "Τελευταία",
                            "next":       "Επόμενο",
                            "previous":   "Προηγούμενο"
                        },
                    },
                    "bPaginate": true,
                    ajax: {
                        'url': api + 'offers',
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    columns: [
                        {
                            data: function (d) {
                                return '<span data-toggle="popover" data-container="body" data-placement="top" data-trigger="hover" title="Υπόλοιπο" data-content="' + d.customer.balance.balance + '€" </span>' + d.customer.name
                            }
                        },
                        { 
                            width: '40%',
                            data: function (d) {
                            return d.comments ? d.comments.substring(0, 150) : '';
                        } },
                        {
                            data: function (d) {
                                return d.user.name
                            }
                        },
                        {
                            data: function (d) {
                                return  moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a')
                            }
                        },
                        {
                            data: function (d) {
                                app5.editFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.createPdf( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-print" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.mailModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-danger btn-outline" onclick='app5.deleteincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                </a>`

                            }
                        },
                    ],
                    "initComplete": function (settings, json) {
                        $('[data-toggle="popover"]').popover();
                        $.contextMenu({
                            selector: 'table#sample_1 tbody tr',
                            callback: function (key, options) {
                                var m = "clicked: " + key;
                                window.console && console.log(m) || alert(m);
                            },
                            items: {
                                "new": {
                                    name: "Νέα Παραγγελία",
                                    icon: "fa-plus",
                                    callback: function (itemKey, opt, rootMenu, originalEvent) {
                                        app5.openNewincomeModal()
                                    }
                                },
                                "print": {
                                    name: "Εκτύπωση Παραγγελίας",
                                    icon: "fa-print",
                                    callback: function (itemKey, opt, rootMenu, originalEvent) {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.createPdf(app5.Table.row(this[0]).data())
                                    }
                                },
                                "edit": {
                                    name: "Επεξεργασία Παραγγελίας",
                                    icon: "edit",
                                    callback: function () {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.editincomeModal( app5.Table.row(this[0]).data())
                                    }
                                },
                                "delete": {
                                    name: "Διαγραφή Παραγγελίας",
                                    icon: "delete",
                                    callback: function () {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.deleteincomeModal(app5.Table.row(this[0]).data())
                                    }
                                },
                            }
                        });
                    },
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
                        { text: 'Προσφορά', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal(true) } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        // { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],
                    rowReorder: {
                        selector: 'tr td:nth-child(2)'
                    },
                    keys: true,
                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "columnDefs": [
                        { "width": "6%", "targets": 1 }
                    ],
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
                app5.Table.on('row-reorder', function (e, diff, edit) {
                    var startedCustomer = edit.triggerRow.data();
                    var finishedCustomer = app5.Table.row(diff[1].node).data();
                    app5.mergeFunds(startedCustomer, finishedCustomer)
                });
                $('#sample_1 tbody').on('dblclick', 'tr', function () {
                    var savedData = app5.Table.row(this).nodes()[0].childNodes[3];
                    var data = app5.Table.row(this).nodes()[0].childNodes[3];
                    app5.selectedFund = app5.Table.row(this).data()
                    data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
                    setTimeout(function () {
                        $('#quicksavevalue').focus()
                    }, 50);
                }).on('key-blur', function (e, datatable, cell) {
                    console.log('s');

                    app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
                });
            }, 300);
        },
        dataTableSingle: function (elementId) {
            setTimeout(function () {
                app5.Table = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
                    },
                    "bPaginate": false,
                    ajax: {
                        'url': api + 'single-fund-result/' + window.location.pathname.substr(window.location.pathname.indexOf('single-fund') + 12, 100),
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    rowCallback: function (row, data) {
                        if (data.customer.has_overcome_balance) {
                            $(row).addClass('redRow');
                        }
                    },
                    columns: [
                        {
                            data: function (d) {
                                console.log(d);
                                
                                return '<span data-toggle="popover" data-container="body" data-placement="top" data-trigger="hover" title="Υπόλοιπο" data-content="' + d.customer.balance.balance + '€" </span>' + d.customer.name
                            },
                            "className": "text-center dtCheck"
                        },
                        { data: 'body' },
                        {
                            data: function (d) {
                                return d.cost + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.payment + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.cars
                            }
                        },
                        {
                            data: function (d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.customer.balance.balance + '€'
                            }
                        },
                        { data: 'fund_code' },
                        {
                            data: function (d) {
                                return d.user.name + ' (' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                return d.last_user.name + ' (' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                return d.delivery ? d.delivery.name : '';
                            }
                        },
                        {
                            data: function (d) {
                                app5.editFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.createPdf( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-print" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.mailModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-danger btn-outline" onclick='app5.deleteincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                </a>`

                            }
                        },
                    ],
                    "initComplete": function (settings, json) {
                        $('[data-toggle="popover"]').popover();
                        $.contextMenu({
                            selector: 'table#sample_1 tbody tr',
                            callback: function (key, options) {
                                var m = "clicked: " + key;
                                window.console && console.log(m) || alert(m);
                            },
                            items: {
                                "new": {
                                    name: "Νέα Παραγγελία",
                                    icon: "fa-plus",
                                    callback: function (itemKey, opt, rootMenu, originalEvent) {
                                        app5.openNewincomeModal()
                                    }
                                },
                                "print": {
                                    name: "Εκτύπωση Παραγγελίας",
                                    icon: "fa-print",
                                    callback: function (itemKey, opt, rootMenu, originalEvent) {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.createPdf(app5.Table.row(this[0]).data())
                                    }
                                },
                                "edit": {
                                    name: "Επεξεργασία Παραγγελίας",
                                    icon: "edit",
                                    callback: function () {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.editincomeModal( app5.Table.row(this[0]).data())
                                    }
                                },
                                "delete": {
                                    name: "Διαγραφή Παραγγελίας",
                                    icon: "delete",
                                    callback: function () {
                                        app5.editFund = app5.Table.row(this[0]).data()
                                        app5.deleteincomeModal(app5.Table.row(this[0]).data())
                                    }
                                },
                            }
                        });
                    },
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        // { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],
                    rowReorder: {
                        selector: 'tr td:nth-child(2)'
                    },
                    keys: true,
                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "columnDefs": [
                        { "width": "6%", "targets": 1 }
                    ],
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
                app5.Table.on('row-reorder', function (e, diff, edit) {
                    var startedCustomer = edit.triggerRow.data();
                    var finishedCustomer = app5.Table.row(diff[1].node).data();
                    app5.mergeFunds(startedCustomer, finishedCustomer)
                });
                $('#sample_1 tbody').on('dblclick', 'tr', function () {
                    var savedData = app5.Table.row(this).nodes()[0].childNodes[3];
                    var data = app5.Table.row(this).nodes()[0].childNodes[3];
                    app5.selectedFund = app5.Table.row(this).data()
                    data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
                    setTimeout(function () {
                        $('#quicksavevalue').focus()
                    }, 50);
                }).on('key-blur', function (e, datatable, cell) {
                    console.log('s');

                    app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
                });
            }, 300);
        },
        dataTablePastFunds: function (elementId) {
            setTimeout(function () {
                app5.Table = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
                    },
                    "bPaginate": false,
                    ajax: {
                        'url': api + 'past-funds-result/' + window.location.pathname.substr(window.location.pathname.indexOf('from='), 100),
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    rowCallback: function (row, data) {
                        if (data.customer.has_overcome_balance) {
                            $(row).addClass('redRow');
                        }
                    },
                    columns: [
                        { data: 'customer.name' },
                        { data: 'body' },
                        {
                            data: function (d) {
                                return d.cost + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.payment + '€'
                            }
                        },
                        { data: 'car_model' },
                        {
                            data: function (d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.customer.balance.balance + '€'
                            }
                        },
                        { data: 'fund_code' },
                        {
                            data: function (d) {
                                return d.user.name + ' (' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                return d.last_user.name + ' (' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                app5.editFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.createPdf( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-print" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.mailModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-danger btn-outline" onclick='app5.deleteincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                </a>`

                            }
                        },
                    ],
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        // { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],
                    rowReorder: {
                        selector: 'tr td:nth-child(2)'
                    },
                    keys: true,
                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "columnDefs": [
                        { "width": "6%", "targets": 1 }
                    ],
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
                app5.Table.on('row-reorder', function (e, diff, edit) {
                    var startedCustomer = edit.triggerRow.data();
                    var finishedCustomer = app5.Table.row(diff[1].node).data();
                    app5.mergeFunds(startedCustomer, finishedCustomer)
                });
                $('#sample_1 tbody').on('dblclick', 'tr', function () {
                    var savedData = app5.Table.row(this).nodes()[0].childNodes[3];
                    var data = app5.Table.row(this).nodes()[0].childNodes[3];
                    app5.selectedFund = app5.Table.row(this).data()
                    data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
                    setTimeout(function () {
                        $('#quicksavevalue').focus()
                    }, 50);
                }).on('key-blur', function (e, datatable, cell) {
                    console.log('s');

                    app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
                });
            }, 300);
        },
        // dataTableSingle: function (elementId) {
        //     setTimeout(function () {
        //         app5.Table = $('#' + elementId).DataTable({
        //             // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        //             "language": {
        //                 "aria": {
        //                     "sortAscending": ": activate to sort column ascending",
        //                     "sortDescending": ": activate to sort column descending"
        //                 },
        //                 "emptyTable": "Δεν υπάρχουν εγγραφές",
        //                 "info": "_TOTAL_ εγγραφές",
        //                 "infoEmpty": "Δεν υπάρχουν εγγραφές",
        //                 "infoFiltered": "(filtered1 from _MAX_ total entries)",
        //                 "lengthMenu": "_MENU_ entries",
        //                 "search": "Αναζήτηση:",
        //                 "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
        //             },
        //             "bPaginate": false,
        //             ajax: {
        //                 'url': api + 'single-fund-result/' + window.location.pathname.substr(window.location.pathname.indexOf('single-fund') + 12, 100),
        //                 "dataSrc": "",
        //                 'rowId': 'id'
        //             },
        //             "bServerSide": false,
        //             columns: [
        //                 { data: 'customer.name' },
        //                 { data: 'body' },
        //                 {
        //                     data: function (d) {
        //                         return d.cost + '€'
        //                     }
        //                 },
        //                 {
        //                     data: function (d) {
        //                         return d.payment + '€'
        //                     }
        //                 },
        //                 { data: 'car_model' },
        //                 {
        //                     data: function (d) {
        //                         return d.total + '€'
        //                     }
        //                 },
        //                 {
        //                     data: function (d) {
        //                         return d.customer.balance.balance + '€'
        //                     }
        //                 },
        //                 { data: 'fund_code' },
        //                 {
        //                     data: function (d) {
        //                         return d.user.name + ' (' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
        //                     }
        //                 },
        //                 {
        //                     data: function (d) {
        //                         return d.last_user.name + ' (' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
        //                     }
        //                 },
        //                 {
        //                     data: function (d) {
        //                         app5.editFund = d;
        //                         return '<a id="index" class="btn btn-default dark btn-outline" onclick="app5.editincomeModal()">' +
        //                             '<span>' +
        //                             '<i class="fa fa-pencil" aria-hidden="true"></i>' +
        //                             '</span>' +
        //                             '</a>' +
        //                             '<a id="index" class="btn btn-default dark btn-outline" onclick="app5.createPdf()">' +
        //                             '<span>' +
        //                             '<i class="fa fa-print" aria-hidden="true"></i>' +
        //                             '</span>' +
        //                             '</a>' +
        //                             '<a id="index" class="btn btn-default dark btn-outline" onclick="app5.mailModal()">' +
        //                             '<span>' +
        //                             '<i class="fa fa-envelope-o" aria-hidden="true"></i>' +
        //                             '</span>' +
        //                             '</a>' +
        //                             '<a id="index" class="btn btn-danger btn-outline" onclick="app5.deleteincomeModal()">' +
        //                             '<span>' +
        //                             '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
        //                             '</span>' +
        //                             '</a>'

        //                     }
        //                 },
        //             ],
        //             // Or you can use remote translation file
        //             //"language": {
        //             //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
        //             //},

        //             // setup buttons extentension: http://datatables.net/extensions/buttons/
        //             buttons: [
        //                 { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
        //                 { text: 'Εκτύπωση', className: 'btn dark btn-outline', action: function () { app5.printCustomerhistory() } },
        //                 // { extend: 'pdf', className: 'btn green btn-outline' },
        //                 { extend: 'csv', className: 'btn purple btn-outline ' }
        //             ],
        //             rowReorder: {
        //                 selector: 'tr td:nth-child(2)'
        //             },
        //             keys: true,
        //             // setup responsive extension: http://datatables.net/extensions/responsive/
        //             responsive: {
        //                 details: {

        //                 }
        //             },
        //             "columnDefs": [
        //                 { "width": "6%", "targets": 1 }
        //             ],
        //             "bDestroy": true,

        //             "aaSorting": [],

        //             "bSort": false,

        //             "order": [
        //                 [0, 'asc']
        //             ],

        //             "lengthMenu": [
        //                 [5, 10, 15, 20, -1],
        //                 [5, 10, 15, 20, "All"] // change per page values here
        //             ],
        //             // set the initial value
        //             "pageLength": 10,

        //             "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

        //             // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
        //             // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
        //             // So when dropdowns used the scrollable div should be removed. 
        //             //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        //         })
        //         app5.Table.on('row-reorder', function (e, diff, edit) {
        //             var startedCustomer = edit.triggerRow.data();
        //             var finishedCustomer = app5.Table.row(diff[1].node).data();
        //             app5.mergeFunds(startedCustomer, finishedCustomer)
        //         });
        //         $('#sample_1 tbody').on('dblclick', 'tr', function () {
        //             var savedData = app5.Table.row(this).nodes()[0].childNodes[3];
        //             var data = app5.Table.row(this).nodes()[0].childNodes[3];
        //             app5.selectedFund = app5.Table.row(this).data()
        //             data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
        //             setTimeout(function () {
        //                 $('#quicksavevalue').focus()
        //             }, 50);
        //         }).on('key-blur', function (e, datatable, cell) {
        //             console.log('s');

        //             app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
        //         });
        //     }, 300);
        // },
        dataTableCustomer: function (elementId) {
            setTimeout(function () {
                app5.Table = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ εγγραφές",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές",
                        "paginate": {
                            "first":      "Πρώτη",
                            "last":       "Τελευταία",
                            "next":       "Επόμενο",
                            "previous":   "Προηγούμενο"
                        },
                    },
                    "bPaginate": true,
                    ajax: {
                        'url': api + 'single-customer-result/' + window.location.pathname.substr(window.location.pathname.indexOf('single-customer') + 16, 100),
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    rowCallback: function (row, data) {
                        if (data.customer.has_overcome_balance) {
                            $(row).addClass('redRow');
                        }
                    },
                    columns: [
                        { data: 'customer.name' },
                        { data: 'body' },
                        {
                            data: function (d) {
                                return d.cost + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.payment + '€'
                            }
                        },
                        { data: 'car_model' },
                        {
                            data: function (d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.customer.balance.balance + '€'
                            }
                        },
                        { data: 'fund_code' },
                        {
                            data: function (d) {
                                return d.user ? d.user.name + ' (' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'  : '(' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                return d.delivery ? d.delivery.name + ' ' + d.delivery.surname : ''
                            } 
                        },
                        {
                            data: function (d) {
                                return d.last_user ? d.last_user.name + ' (' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')' : '(' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                app5.editFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.createPdf( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-print" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.mailModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-danger btn-outline" onclick='app5.deleteincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                </a>`

                            }
                        },
                    ],
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
                        { text: 'Εκτύπωση', className: 'btn dark btn-outline', action: function () { app5.printCustomerhistory() } },
                        // { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],
                    rowReorder: {
                        selector: 'tr td:nth-child(2)'
                    },
                    keys: true,
                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "columnDefs": [
                        { "width": "6%", "targets": 1 }
                    ],
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
                app5.Table.on('row-reorder', function (e, diff, edit) {
                    var startedCustomer = edit.triggerRow.data();
                    var finishedCustomer = app5.Table.row(diff[1].node).data();
                    app5.mergeFunds(startedCustomer, finishedCustomer)
                });
                $('#sample_1 tbody').on('dblclick', 'tr', function () {
                    var savedData = app5.Table.row(this).nodes()[0].childNodes[3];
                    var data = app5.Table.row(this).nodes()[0].childNodes[3];
                    app5.selectedFund = app5.Table.row(this).data()
                    data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
                    setTimeout(function () {
                        $('#quicksavevalue').focus()
                    }, 50);
                }).on('key-blur', function (e, datatable, cell) {
                    console.log('s');

                    app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
                });
            }, 300);
        },
        dataTableProvince: function (elementId) {
            setTimeout(function () {
                app5.Table = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
                    },
                    "bPaginate": false,
                    ajax: {
                        'url': api + 'get-province',
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    columns: [
                        { data: 'customer.name' },
                        { data: 'provinceWay' },
                        { data: 'provinceCode' },
                        {
                            data: function (d) {
                                return d.cost + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.payment + '€'
                            }
                        },
                        {
                            data: function (d) {
                                if (d.deposit) {
                                    return d.deposit + '€'
                                }
                                return 0 + '€'
                            }
                        },
                        {
                            data: function (d) {
                                if (d.deposit) {
                                    return (d.cost - (d.payment + d.deposit)) + '€'
                                }
                                return (d.cost - d.payment) + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.total + '€'
                            }
                        },
                        {
                            data: function (d) {
                                return d.customer.balance.balance + '€'
                            }
                        },
                        { data: 'fund_code' },
                        {
                            data: function (d) {
                                return d.user.name + ' (' + moment(d.created_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                return d.last_user.name + ' (' + moment(d.updated_at).locale('el').format('D MMMM YYYY, h:mm:ss a') + ')'
                            }
                        },
                        {
                            data: function (d) {
                                app5.editFund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick='app5.editincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.createPdf( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-print" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-default dark btn-outline" onclick='app5.mailModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                </a>
                                <a id="index" class="btn btn-danger btn-outline" onclick='app5.deleteincomeModal( ${JSON.stringify(d)} )'>
                                <span>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </span>
                                </a>`

                            }
                        },
                    ],
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewincomeModal() } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        // { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],
                    rowReorder: {
                        selector: 'tr td:nth-child(2)'
                    },
                    keys: true,
                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "columnDefs": [
                        { "width": "6%", "targets": 1 }
                    ],
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
                app5.Table.on('row-reorder', function (e, diff, edit) {
                    var startedCustomer = edit.triggerRow.data();
                    var finishedCustomer = app5.Table.row(diff[1].node).data();
                    app5.mergeFunds(startedCustomer, finishedCustomer)
                });
                $('#sample_1 tbody').on('dblclick', 'tr', function () {
                    var savedData = app5.Table.row(this).nodes()[0].childNodes[4];
                    var data = app5.Table.row(this).nodes()[0].childNodes[4];
                    app5.selectedFund = app5.Table.row(this).data()
                    data.innerHTML = '<input id="quicksavevalue" style="width: 60px;" value="' + app5.selectedFund.payment + '" type="text" onkeypress="app5.quickSaveFund(event,' + app5.selectedFund.id + ')"/>'
                    setTimeout(function () {
                        $('#quicksavevalue').focus()
                    }, 50);
                }).on('key-blur', function (e, datatable, cell) {

                    app5.unFocus(app5.funds[cell.node().id.substr(8, 80)], cell.node().id.substr(8, 80));
                });
            }, 300);
        },
        dataTableOutcome: function (elementId) {
            setTimeout(function () {
                app5.TableOutfunds = $('#' + elementId).DataTable({
                    // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                    "language": {
                        "aria": {
                            "sortAscending": ": activate to sort column ascending",
                            "sortDescending": ": activate to sort column descending"
                        },
                        "emptyTable": "Δεν υπάρχουν εγγραφές",
                        "info": "_TOTAL_ εγγραφές",
                        "infoEmpty": "Δεν υπάρχουν εγγραφές",
                        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                        "lengthMenu": "_MENU_ entries",
                        "search": "Αναζήτηση:",
                        "zeroRecords": "Δεν βρέθηκαν σχετικές εγγραφές"
                    },
                    "bPaginate": false,
                    ajax: {
                        'url': api + 'all-outfunds',
                        "dataSrc": "",
                        'rowId': 'id'
                    },
                    "bServerSide": false,
                    columns: [
                        { data: 'outcome.name' },
                        { data: 'total' },
                        {
                            data: function (d) {
                                app5.selectedOutfund = d;
                                return `<a id="index" class="btn btn-default dark btn-outline" onclick="app5.editOutcomeModal( ${JSON.stringify(d) } )">
                                    <span>
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </span>
                                    </a>
                                    <a id="index" class="btn btn-danger btn-outline" onclick="app5.deleteOutcomeModal( ${JSON.stringify(d) } )">
                                    <span>
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </span>
                                    </a>`

                            }
                        },
                    ],
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // setup buttons extentension: http://datatables.net/extensions/buttons/
                    buttons: [
                        { text: 'Νέο', className: 'btn dark btn-outline', action: function () { app5.openNewOutcomeModal() } },
                        { extend: 'print', className: 'btn dark btn-outline' },
                        { extend: 'pdf', className: 'btn green btn-outline' },
                        { extend: 'csv', className: 'btn purple btn-outline ' }
                    ],

                    // setup responsive extension: http://datatables.net/extensions/responsive/
                    responsive: {
                        details: {

                        }
                    },
                    "bDestroy": true,

                    "aaSorting": [],

                    "bSort": false,

                    "order": [
                        [0, 'asc']
                    ],

                    "lengthMenu": [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 10,

                    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                })
            }, 300);
        },
    }
});
