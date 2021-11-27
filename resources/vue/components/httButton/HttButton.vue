<template lang="pug">
	div.button(:class="{'animate': $props.buttonIcon, 'action': $props.buttonAction}", :data-tooltip="$props.tooltip")
		button(:type="$props.buttonType", :disabled="$props.buttonDisabled", ref="button", @click="$emit('click', $event)", v-if='$props.buttonAction').action
			img(:src='$props.buttonIcon')
		button(:type="$props.buttonType", :disabled="$props.buttonDisabled", ref="button", @click="$emit('click', $event)", v-else)
			span.texto {{ $props.buttonText }}
</template>

<script>
export default {
	props: {
		tooltip: {
			type: String,
		},
		buttonType: {
			type: String,
			required: true,
			validator: function(val) {
				return ["submit", "reset", "button"].indexOf(val) !== -1;
			}
		},
		buttonAction: {
			type: Boolean,
			default: false,
		},
		buttonDisabled: Boolean,
		buttonText: {
			type: String,
			default: "Enviar"
		},
		buttonIcon: String
	},
	mounted() {
		if(!this.$props.buttonAction){
			if (this.$props.buttonIcon)
				this.$refs.button.style.backgroundImage = `url(${this.$props.buttonIcon})`;
		}
	}
};
</script>

<style lang="stylus" scoped src="./HttButton.styl"></style>
