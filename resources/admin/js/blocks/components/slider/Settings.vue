<template>
    <div class="block-settings">
        <el-tabs v-model="activeTab">
            <el-tab-pane label="General" name="general">
                <div class="form-group">
                    <label>Block Title</label>
                    <input type="text" class="form-control" v-model="settings.blockTitle">
                </div>

                <div class="form-group">
                    <label>Style</label>
                    <select class="form-control" v-model="settings.contentRenderStyle">
                        <option value='fluid'>Fluid</option>
                        <option value='boxed'>Boxed</option>
                    </select>
                </div>

                <div v-if="!settings.heightResponsive" class="form-group">
                    <label>Height</label> <i @click="settings.heightResponsive = !settings.heightResponsive" class="lo-icon lo-icon-desktop" title="Responsive"></i>
                    <px :px.sync="settings.height"></px>
                </div>
                <div v-else class="form-group">
                    <label>Height</label> <i @click="settings.heightResponsive = !settings.heightResponsive" class="lo-icon lo-icon-desktop" title="Responsive"></i>
                    <px-responsive
                        :extraLarge.sync="settings.height"
                        :large.sync="settings.heightLarge"
                        :medium.sync="settings.heightMedium"
                        :small.sync="settings.heightSmall"
                        :extraSmall.sync="settings.heightExtraSmall"
                    >
                    </px-responsive>
                </div>

                <!-- <div v-if="!settings.paddingResponsive" class="form-group">
                    <label>Padding</label> <i @click="settings.paddingResponsive = !settings.paddingResponsive" class="lo-icon lo-icon-desktop" title="Responsive"></i>
                    <px :px.sync="settings.padding"></px>
                </div>
                <div v-else class="form-group">
                    <label>Padding</label> <i @click="settings.paddingResponsive = !settings.paddingResponsive" class="lo-icon lo-icon-desktop" title="Responsive"></i>
                    <px-responsive
                        :extraLarge.sync="settings.padding"
                        :large.sync="settings.paddingLarge"
                        :medium.sync="settings.paddingMedium"
                        :small.sync="settings.paddingSmall"
                        :extraSmall.sync="settings.paddingExtraSmall"/>
                </div> -->

                <div v-if="!settings.marginResponsive" class="form-group">
                    <label>Margin</label> <i @click="settings.marginResponsive = !settings.marginResponsive" class="lo-icon lo-icon-desktop" title="Responsive"></i>
                    <px :px.sync="settings.margin"></px>
                </div>
                <div v-else class="form-group">
                    <label>Margin</label> <i @click="settings.marginResponsive = !settings.marginResponsive" class="lo-icon lo-icon-desktop" title="Responsive"></i>
                    <px-responsive
                        :extraLarge.sync="settings.margin"
                        :large.sync="settings.marginLarge"
                        :medium.sync="settings.marginMedium"
                        :small.sync="settings.marginSmall"
                        :extraSmall.sync="settings.marginExtraSmall"
                    >
                    </px-responsive>
                </div>

                <div class="form-group">
                    <label>Transition Effect</label>
                    <select class="form-control" v-model="settings.transition">
                        <option v-for="(transition, key) in transitions" :value='key'>{{ transition }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Loop</label>
                    <select class="form-control" v-model="settings.loop">
                        <option v-bind:value='true'>Yes</option>
                        <option v-bind:value='false'>No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Autoplay</label>
                    <select class="form-control" v-model="settings.autoplay">
                        <option v-bind:value='true'>Yes</option>
                        <option v-bind:value='false'>No</option>
                    </select>
                </div>

                <div v-if="settings.autoplay" class="form-group">
                    <label>Autoplay Duration</label>
                    <input type="text" class="form-control" v-model="settings.autoplayDuration">
                    <small>Duration between slides in milliseconds.</small>
                </div>

                <div v-if="settings.autoplay" class="form-group">
                    <label>Show progressbar</label>
                    <select class="form-control" v-model="settings.showProgressBar">
                        <option v-bind:value='true'>Yes</option>
                        <option v-bind:value='false'>No</option>
                    </select>
                </div>

                <div v-if="settings.showProgressBar" class="form-group">
                    <label>Progressbar Color</label>
                    <color-picker type="text" v-model="settings.progressBarColor"></color-picker>
                </div>

                <div class="form-group">
                    <label>Show Arrows</label>
                    <select class="form-control" v-model="settings.showArrows">
                        <option value='no'>No</option>
                        <option value='always'>Allways</option>
                        <option value='hover'>On Hover</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Show Buttons</label>
                    <select class="form-control" v-model="settings.showButtons">
                        <option value='no'>No</option>
                        <option value='always'>Always</option>
                        <option value='hover'>On Hover</option>
                    </select>
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
        data() {
            return {
                transitions: {
                    fade: 'Fade',
                    slideHorisontal: 'Slide Horisontal',
                    slideVertical: 'Slide Vertical',
                    zoomOutSlideIn: 'Zoom Out Slide In',
                },
            }
        },
        customSettings: {
            blockTitle: {type: String, default: 'Slider'},
            contentRenderStyle: {type: String, default: 'fluid'},

            showArrows: {type: String, default: 'always'},
            showButtons: {type: String, default: 'always'},
            autoplay: {type: Boolean, default: false},
            autoplayDuration: {type: Number, default: 6000},
            loop: {type: Boolean, default: true},
            transition: {type: String, default: 'slideHorisontal'},
            showProgressBar: {type: Boolean, default: false},
            progressBarColor: {type: String, default: '#007AFF'},

            heightResponsive: {type: Boolean, default: false},
            height: {type: String, default: '450px'},
            heightLarge: {type: String, default: ''},
            heightMedium: {type: String, default: ''},
            heightSmall: {type: String, default: ''},
            heightExtraSmall: {type: String, default: ''},

            paddingResponsive: {type: Boolean, default: false},
            padding: {type: String, default: '0px'},
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

            css: {type: String, default: ''},
        }
    }
</script>
