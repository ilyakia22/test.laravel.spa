<template>
	<div>
		<div class="alert alert-danger" v-if="msgErrors.faild">{{ msgErrors.faild }}</div>
		<div class="w-50">
			<div class="mb-3">
				<label for="name" class="form-label">Имя</label>
				<input type="text" v-model="name" class="form-control" id="name">
				<span v-if="msgErrors.name" class="text-danger">{{ msgErrors.name }}</span>
			</div>
			<div class="mb-3">
				<label for="phone" class="form-label">Телефон</label>
				<input type="text" v-model="phone" class="form-control" id="phone">
				<span v-if="msgErrors.phone" class="text-danger">{{ msgErrors.phone }}</span>
			</div>
			<div class="mb-3">
				<label for="comment" class="form-label">Комментарий</label>
				<textarea class="form-control" v-model="comment" id="comment"></textarea>
				<span v-if="msgErrors.comment" class="text-danger">{{ msgErrors.comment }}</span>
			</div>
			<div class="mb-3">
				<button @click.prevent="contactCreate" class="btn btn-primary">Добавить контакт к сделке</button>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios';

export default {
	name: "ContactFormComponent",
	data() {
		return {
			name: null,
			phone: null,
			comment: null,
			msgErrors: { name: null, phone: null, comment: null, faild: null },
		}
	},
	methods: {

		contactCreate() {
			for (const [key, value] of Object.entries(this.msgErrors)) {
				this.msgErrors[key] = null;
			}
			axios.post('/api/contact', { lead_id: this.$route.params.lead_id, name: this.name, phone: this.phone, comment: this.comment })
				.then(res => {
					this.$router.push({ name: 'main' })
				})
				.catch(error => {
					if (error.response.data.errors) {
						let errors = error.response.data.errors;
						errors.name ? this.msgErrors.name = errors.name.join(", ") : this.msgErrors.name = '';
						errors.phone ? this.msgErrors.phone = errors.phone.join(", ") : this.msgErrors.phone = '';
						errors.comment ? this.msgErrors.comment = errors.comment.join(", ") : this.msgErrors.comment = '';
					}
					else {
						this.msgErrors.faild = 'Oopps, try again.';
					}
				});
		}
	}
}
</script>

<style scoped></style>