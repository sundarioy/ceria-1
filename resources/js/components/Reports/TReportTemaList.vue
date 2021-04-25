<template>
	<div id="comp-subtema">
		<div class="col">
			<select class="custom-select" id="inputTema" @change="subtemaChange">
				<option v-for="(index, value) in options" :value="value">{{ value }}</option>
			</select>
		</div>
	</div>
</template>

<script>
export default {
	props: ['options']
}
</script>