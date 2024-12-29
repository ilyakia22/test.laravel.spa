<template>
	<div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Название сделки</th>
					<th scope="col">Дата создания</th>
					<th scope="col">Есть контакт</th>
					<th scope="col">Действия</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="lead in leads">
					<LeadRowComponent :lead="lead"></LeadRowComponent>
				</template>
			</tbody>
		</table>


	</div>
</template>

<script>
import LeadRowComponent from './LeadRowComponent.vue';
export default {
	name: "LeadComponent",
	mounted() {
		this.$store.dispatch('getLeads')
	},
	computed: {
		leads() {
			return this.$store.getters.leads
		}
	},
	components: {
		LeadRowComponent
	}
}
</script>

<style scoped></style>