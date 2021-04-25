<style type="text/css">
	.pagination {
		justify-content: flex-end !important;

		.page-stats {
			align-items: center;
			margin-right: 5px;
		}

		i {
			color: #3273dc !important;
		}
	}
</style>

<template>
	<nav class="pagination">
		<span class="page-stats">
			{{ pagination.from }} - {{ pagination.to }} of {{ pagination.total }}
			<a href="" v-if="pagination.prevPageUrl" class="button is-small pagination-previous" @click="$emit('prev">
				Prev
			</a>
			<a href="" class="button is-small pagination-previous" v-else :disabled="true">
				Prev
			</a>
			<a href="" v-if="pagination.nextPageUrl" class="button is-small pagination-next" @click="$emit('next')">
				Next
			</a>
			<a href="" class="button is-small pagination-next" v-else :disabled="true">
				Next
			</a>
		</span>
	</nav>
	
</template>

<script>
	export default {
		props: ['pagination']
	}
</script>