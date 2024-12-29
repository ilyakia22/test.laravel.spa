<template>
	<div>
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Дата/время</th>
					<th scope="col">Комментарий</th>
					<th scope="col">Тип</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="log in logs">
					<tr>
						<th scope="row">{{ log.created_at }}</th>
						<td>{{ log.comment }}</td>
						<td>{{ log.type_label }}</td>
					</tr>
				</template>
			</tbody>
		</table>


	</div>
</template>

<script>
export default {
	name: "LogComponent",
	mounted() {
		this.$store.dispatch('getLogs')
	},
	computed: {
		logs() {
			return this.$store.getters.logs
		}
	},
	components: {

	}
}
</script>

<style scoped></style>