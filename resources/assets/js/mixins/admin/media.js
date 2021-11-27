let media_mixin = {
	data: function () {
		return {
			media_root: '',
			select_media: '',
			medias: [],
		}
	},
	methods: {
		setSelectedMedia(pId) {
			this.select_media = pId;
			// setTimeout(function () {
			// 	app.$data.select_media = ''
			// }, 4000);
		},
		getMediaThumbPath: function getMediaThumbPath(pMedia) {
			if (pMedia !== undefined && pMedia !== null && pMedia.media_root !== undefined && pMedia.media_root !== null) {
				return this.base_url + '/' + pMedia.media_root.path + 'thumb/' + (pMedia.tipo === 1 ? pMedia.file : pMedia.thumbnail);
			} else return '';
		},
		loadAssets: function loadAssets() {
			this.select_media = '';
			$.ajax({
				url: base_url + "/admin/api/media/" + app.$data.media_root,
				method: "GET",
				async: true
			}).done(function (response) {
				if (response.registros !== undefined) {
					app.$data.medias = response.registros;
					app.$data.medias.forEach(function (element) {
						if (element.tipo === 2) element.file = element.thumbnail;
					});
				} else app.$data.medias = [];
			});
		}
	}
};
