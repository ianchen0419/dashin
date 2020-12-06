var el = wp.element.createElement;
var InnerBlocks = wp.blockEditor.InnerBlocks;

var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
var TextControl=wp.components.TextControl;
var select=wp.data.select;
var dispatch=wp.data.dispatch;
var withSelect=wp.data.withSelect;

var useSelect=wp.data.useSelect;
var useEntityProp=wp.coreData.useEntityProp;

var InspectorControls = wp.blockEditor.InspectorControls;
var PanelBody = wp.components.PanelBody;
var PanelRow = wp.components.PanelRow;
var BaseControl=wp.components.BaseControl;
var RadioControl=wp.components.RadioControl;
var ToggleControl=wp.components.ToggleControl;
var ButtonGroup=wp.components.ButtonGroup;
var Button=wp.components.Button;

var assign=lodash.assign;


//トップページスライダーギャラリー
wp.blocks.registerBlockStyle(
	'core/group', {
		name: 'slider',
		label: '首頁幻燈片秀'
	}
)


// 上下マージン設定
var withInspectorControls = wp.compose.createHigherOrderComponent(function(BlockEdit) {
	return function(props) {

		var attributes=props.attributes;

		var marginTopSettings=el(
			PanelBody,
			{
				title: '上下邊界',
			},
			el(
				BaseControl,
				{
							// label: '調整上下邊界',
						},
						el(
							ButtonGroup,
							{},
							el(
								Button,
								{
									value: '0',
									isPressed: (props.attributes.margin === '0'),
									isSmall: true,
									onClick: onClickMarginButton,
								},
								'無',
								),
							el(
								Button,
								{
									value: '20',
									isPressed: (props.attributes.margin === '20'),
									isSmall: true,
									onClick: onClickMarginButton,
								},
								'小'
								),
							el(
								Button,
								{
									value: '40',
									isPressed: (props.attributes.margin === '40'),
									isSmall: true,
									onClick: onClickMarginButton,
								},
								'中'
								),
							el(
								Button,
								{
									value: '60',
									isPressed: (attributes.margin === '60'),
									isSmall: true,
									onClick: onClickMarginButton,
								},
								'大'
								),

							),
						el(
							Button,
							{
								value: '',
								isSmall: true,
								onClick: onClickMarginButton,
							},
							'重設'
							),
						)
			);

		function onClickMarginButton(ev){
			var marginValue=ev.currentTarget.value;
			if(marginValue==''){
				props.setAttributes({
					margin: marginValue,
					className: '',
				});
			}else{
				props.setAttributes({
					margin: marginValue,
					className: 'margin'+marginValue,
				});
			}

		}

		return el(
			wp.element.Fragment,
			{},
			el(
				BlockEdit,
				props,
				),
			el(
				wp.blockEditor.InspectorControls,
				{initialOpen: false},
				marginTopSettings,
				),
			)


	};
}, 'withInspectorControls');
wp.hooks.addFilter('editor.BlockEdit', 'my-plugin/add-margin', withInspectorControls);

function addAttribute(settings) {
	settings.attributes=assign(settings.attributes, {
		margin: {
			type: 'string',
		},
	} );
	return settings;
}
wp.hooks.addFilter('blocks.registerBlockType', 'my-plugin/add-attr', addAttribute);