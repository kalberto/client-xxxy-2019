let banner_mixin = {
	data: function () {
		return {
			registro: {
				banner_desktop: '',
				banner_mobile: '',
				media: false
			},
			identifiers: {
				'banner_desktop': {
					'id': 'banner_desktop_id',
					'media': 'banner_desktop'
				},
				'banner_mobile': {
					'id': 'banner_mobile_id',
					'media': 'banner_mobile'
				}
			}
		}
	},
	methods: {
		callLoadAssets(pIdentifier) {
			this.media_root = pIdentifier;
			this.loadAssets();
		},
		selectMedia(pId, pIndex) {
			this.registro[this.identifiers[this.media_root].id] = pId;
			this.registro[this.identifiers[this.media_root].media] = this.medias[pIndex];
			removeErrorMessage($("input[name='" + this.identifiers[this.media_root].id + "']"));
		},
		removeMedia(pIdentifier) {
			this.registro[this.identifiers[pIdentifier].id] = '';
			this.registro[this.identifiers[pIdentifier].media] = false;
		}
	}
};
