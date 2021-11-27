<template lang="pug">
	div.input(v-if="inputShow", :class="{ 'search': $props.inputType.toLowerCase() == 'search' }")
		label(:for="inputNameComp", :class="{ 'ativo': labelAtivo }") {{ inputLabel }}
		input(v-if="$props.inputMoney",
			:type="$props.inputType",
			:id="inputNameComp",
			:name="inputNameComp",
			v-model.lazy="value",
			@input="$emit('update:inputValue', value)",
			@focus="labelAtivo = true",
			@blur="blurAtivo()",
			:disabled="$props.inputDisabled",
			autocomplete="off",
			v-money="$props.inputMoney")
		input(v-if="$props.inputMask",
			:type="$props.inputType", 
			:id="inputNameComp", 
			:name="inputNameComp", 
			v-model="value", 
			@input="$emit('update:inputValue', value)",
			@focus="labelAtivo = true",
			@blur="blurAtivo()",
			:disabled="$props.inputDisabled",
			autocomplete="off",
			v-mask="$props.inputMask")
		input(v-if="!$props.inputMoney && !$props.inputMask",
			:type="$props.inputType", 
			:id="inputNameComp", 
			:name="inputNameComp", 
			v-model="value", 
			@input="$emit('update:inputValue', value)",
			@focus="labelAtivo = true",
			@blur="blurAtivo()",
			:disabled="$props.inputDisabled",
			autocomplete="off")
		button(@click="$emit('doSearch', $event)", v-if="$props.inputType.toLowerCase() == 'search'")
			i.material-icons search
		span.message {{ message }}
</template>

<script>
import {mask} from 'vue-the-mask'

export default {
  	directives: {mask},
	props: {
		inputValue: {
			type: String,
			default: ""
		},
		inputName: {
			type: String,
			required: true
		},
		inputMessage: String,
		inputLabel: {
			type: String,
			required: true
		},
		inputMask:{
			default: ''
		},
		inputMoney:{
			default: ''
		},
		inputDisabled: Boolean,
		inputShow:{
			type:Boolean,
			default:true
		},
		inputType: {
			type: String,
			required: true,
			validator: function(val) {
				return (
					[
						"text",
						"tel",
						"email",
						"password",
						"number",
						"search",
						"url"
					].indexOf(val) !== -1
				);
			}
		}
	},
	data() {
		return {
			value: "",
			message: "",
			labelAtivo: false
		};
	},
	computed: {
		inputNameComp: function() {
			if (this.$props.inputName.search(/^input_/) > 0)
				return this.$props.inputName;
			return `input_${this.$props.inputName}`;
		},
	},
	created() {
		this.value = this.$props.inputValue;
		this.message = this.$props.inputMessage;
		if (this.value) this.labelAtivo = true;
	},
	watch: {
		'$props.inputValue': function() {
			this.value = this.$props.inputValue;
			if (this.value) this.labelAtivo = true;
		},
		'$props.inputMessage': function() {
			this.message = this.$props.inputMessage;
		}
	},
	methods: {
		blurAtivo() {
			!this.value ? this.labelAtivo = false : this.labelAtivo = true
			this.$emit('blur')
		}
	},
};
</script>

<style lang="stylus" scoped src="./HttInput.styl"></style>
