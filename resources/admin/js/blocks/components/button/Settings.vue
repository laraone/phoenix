<template>
    <div class="block-settings">
        <el-tabs v-model="activeTab">
            <el-tab-pane label="General" name="general">
                <div class="form-group">
                    <label>Block Title</label>
                    <input type="text" class="form-control" v-model="settings.blockTitle">
                </div>

                <div class="form-group">
                    <label>Tag</label>
                    <select class="form-control" v-model="settings.textTag">
                        <option value='h1'>h1</option>
                        <option value='h2'>h2</option>
                        <option value='h3'>h3</option>
                        <option value='h4'>h4</option>
                        <option value='div'>div</option>
                    </select>
                </div>

                <div v-if="settings.textTag=='div'" class="form-group">
                    <label>Font Size</label>
                    <px :maxAllowed=1 v-model="settings.fontSize"></px>
                </div>

                <div class="form-group">
                    <label>Weight</label>
                    <select class="form-control" v-model="settings.fontWeight">
                        <option value='default'>Default</option>
                        <option value='100'>Light</option>
                        <option value='400'>Regular</option>
                        <option value='700'>Bold</option>
                    </select>
                </div>

                <div v-if="!settings.textColorAdvanced" class="form-group">
                    <label>Text Color</label> <i @click="settings.textColorAdvanced = !settings.textColorAdvanced" class="lo-icon lo-icon-plus-circled pull-right" title="Advanced"></i>
                    <color-picker v-model="settings.textColor"></color-picker>
                </div>
                <div v-else class="form-group">
                    <label>Text Color</label> <i @click="settings.textColorAdvanced = !settings.textColorAdvanced" class="lo-icon lo-icon-minus-circled pull-right" title="Simple"></i>
                    <color
                        :standard.sync="settings.textColor"
                        :hover.sync="settings.textColorHover"
                        :active.sync="settings.textColorActive">
                    </color>
                </div>

                <div v-if="!settings.backgroundColorAdvanced" class="form-group">
                    <label>Button Color</label> <i @click="settings.backgroundColorAdvanced = !settings.backgroundColorAdvanced" class="lo-icon lo-icon-plus-circled pull-right" title="Advanced"></i>
                    <color-picker v-model="settings.backgroundColor"></color-picker>
                </div>
                <div v-else class="form-group">
                    <label>Button Color</label> <i @click="settings.backgroundColorAdvanced = !settings.backgroundColorAdvanced" class="lo-icon lo-icon-minus-circled pull-right" title="Simple"></i>
                    <color
                        :standard.sync="settings.backgroundColor"
                        :hover.sync="settings.backgroundColorHover"
                        :active.sync="settings.backgroundColorActive"
                        :focus.sync="settings.backgroundColorFocus">
                    </color>
                </div>

                <div v-if="!settings.widthResponsive" class="form-group">
                    <label>Width</label> <i @click="settings.widthResponsive = !settings.widthResponsive" class="lo-icon lo-icon-desktop pull-right" title="Responsive"></i>
                    <px :maxAllowed=1 :px.sync="settings.width"></px>
                </div>

                <div v-if="settings.widthResponsive" class="form-group">
                    <label>Width</label> <i @click="settings.widthResponsive = !settings.widthResponsive" class="lo-icon lo-icon-desktop pull-right" title="Responsive Off"></i>
                    <px-responsive
                        :extraLarge.sync="settings.width"
                        :large.sync="settings.widthLarge"
                        :medium.sync="settings.widthMedium"
                        :small.sync="settings.widthSmall"
                        :extraSmall.sync="settings.widthExtraSmall">
                    </px-responsive>
                </div>

                <div class="form-group">
                    <label>Border Radius</label>
                    <px :px.sync="settings.borderRadius"></px>
                </div>

                <div v-if="!settings.paddingResponsive" class="form-group">
                    <label>Padding</label> <i @click="settings.paddingResponsive = !settings.paddingResponsive" class="lo-icon lo-icon-desktop pull-right" title="Responsive"></i>
                    <px :px.sync="settings.padding"></px>
                </div>
                <div v-else class="form-group">
                    <label>Padding</label> <i @click="settings.paddingResponsive = !settings.paddingResponsive" class="lo-icon lo-icon-desktop pull-right" title="Responsive Off"></i>
                    <px-responsive
                        :extraLarge.sync="settings.padding"
                        :large.sync="settings.paddingLarge"
                        :medium.sync="settings.paddingMedium"
                        :small.sync="settings.paddingSmall"
                        :extraSmall.sync="settings.paddingExtraSmall">
                    </px-responsive>
                </div>

                <div v-if="!settings.marginResponsive" class="form-group">
                    <label>Margin</label> <i @click="settings.marginResponsive = !settings.marginResponsive" class="lo-icon lo-icon-desktop pull-right" title="Responsive"></i>
                    <px :px.sync="settings.margin"></px>
                </div>
                <div v-else class="form-group">
                    <label>Margin</label> <i @click="settings.marginResponsive = !settings.marginResponsive" class="lo-icon lo-icon-desktop pull-right" title="Responsive Off"></i>
                    <px-responsive
                        :extraLarge.sync="settings.margin"
                        :large.sync="settings.marginLarge"
                        :medium.sync="settings.marginMedium"
                        :small.sync="settings.marginSmall"
                        :extraSmall.sync="settings.marginExtraSmall">
                    </px-responsive>
                </div>

                <div class="form-group">
                    <label>Custom Class</label>
                    <input type="text" class="form-control" v-model="settings.customClass">
                </div>
            </el-tab-pane>
            <el-tab-pane label="Actions" name="actions">
                <div class="form-group">
                    <label>On Click</label>
                    <select class="form-control" v-model="settings.onClick">
                        <option value='nothing'>Do Nothing</option>
                        <option value='open-link'>Open Link</option>
                    </select>
                </div>

                <div v-if="settings.onClick=='open-link'" class="form-group">
                    <label>Open Link In</label>
                    <select class="form-control" v-model="settings.target">
                        <option value='_blank'>New Tab</option>
                        <option value='_self'>Same Tab</option>
                    </select>
                </div>

                <div v-if="settings.onClick=='open-link'" class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" v-model="settings.link">
                </div>
            </el-tab-pane>

            <el-tab-pane label="Css" name="css">
                <div class="form-group">
                    <prism-editor v-if="!$root.isFirefox" v-model="settings.css" :lineNumbers=true language="css"></prism-editor>
                    <textarea v-else v-model="settings.css" class="form-control" rows="3"></textarea>
                </div>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    import SettingsMixin from '../../mixins/SettingsMixin'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        mixins: [SettingsMixin],
        customSettings: {
            blockTitle: {type: String, default: 'Button'},
            buttonText: {type: String, default: 'Button'},
            textTag: {type: String, default: 'h3'},
            customClass: {type: String, default: ''},

            widthResponsive: {type: Boolean, default: false},
            width: {type: String, default: '300px'},
            widthLarge: {type: String, default: ''},
            widthMedium: {type: String, default: ''},
            widthSmall: {type: String, default: ''},
            widthExtraSmall: {type: String, default: ''},

            fontSize: {type: String, default: 'default'},
            fontWeight: {type: String, default: 'default'},

            textColorAdvanced: {type: Boolean, default: false},
            textColor: {type: String, default: 'white'},
            textColorHover: {type: String, default: ''},
            textColorActive: {type: String, default: ''},
            textColorFocus: {type: String, default: ''},

            backgroundColorAdvanced: {type: Boolean, default: false},
            backgroundColor: {type: String, default: '#1CA8D4'},
            backgroundColorHover: {type: String, default: ''},
            backgroundColorActive: {type: String, default: ''},
            backgroundColorFocus: {type: String, default: ''},

            borderAdvanced: {type: Boolean, default: false},
            border: {type: String, default: ''},
            borderHover: {type: String, default: ''},
            borderActive: {type: String, default: ''},
            borderFocus: {type: String, default: ''},

            borderRadius: {type: String, default: '0px'},
            alignButton: {type: String, default: 'flex-start'},

            paddingResponsive: {type: Boolean, default: false},
            padding: {type: String, default: '10px 45px'},
            paddingLarge: {type: String, default: ''},
            paddingMedium: {type: String, default: ''},
            paddingSmall: {type: String, default: ''},
            paddingExtraSmall: {type: String, default: ''},

            marginResponsive: {type: Boolean, default: false},
            margin: {type: String, default: '0px 0px 15px 0px'},
            marginLarge: {type: String, default: ''},
            marginMedium: {type: String, default: ''},
            marginSmall: {type: String, default: ''},
            marginExtraSmall: {type: String, default: ''},

            onClick: {type: String, default: 'open-link'},
            target: {type: String, default: '_self'},
            link: {type: String, default: ''},

            css: {type: String, default: ''},
        }
    }
</script>
