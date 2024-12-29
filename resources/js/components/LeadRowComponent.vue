<template>
	<tr>
		<th scope="row">{{ lead.id }}</th>
		<td>{{ lead.name }}</td>
		<td>{{ lead.created_at }}</td>
		<td>{{ lead.is_exists_contact ? 'Да' : 'Нет' }}</td>
		<td>
			<div v-if="!lead.is_exists_contact">
				<router-link :to="{ name: 'contact.add.lead', params: { lead_id: lead.id } }" class="btn btn-primary">
					Привязать контакт</router-link>
			</div>
			<div v-else>
				<button disabled class="btn btn-primary">Привязать контакт</button>
			</div>

		</td>
	</tr>
</template>

<script>
export default {
	name: "LeadRowComponent",
	data() {
		return {

		}
	},
	props: [
		'lead'
	],
	mounted() {

	},
	methods: {

	}
}
</script>

<style scoped></style>