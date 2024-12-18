import Vue from 'vue'
import VueRouter from 'vue-router'

import example from './components/Example.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{
			path: '/test',
			component: example
		}
	]
})

export default router