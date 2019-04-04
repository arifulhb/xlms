<template>
  <div>
    <fm-app-settings-button 
      :align="localButtonAlign"></fm-app-settings-button>
    <fm-app-settings-drawer
      namespace="learnplus-v4.2.0" 
      :options="computedOptions" 
      :drawer-align="localDrawerAlign"
      :sidebar-type="sidebarType"
      :sidebar-variant="sidebarVariant"></fm-app-settings-drawer> 
  </div>
</template>

<style scoped>
.app-settings-button {
  top: 132px !important;
}
</style>

<script>
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue)

import 'bootstrap-vue/dist/bootstrap-vue.css'

import { 
  FmToggleDirective, 
  FmAppSettingsButton, 
  FmAppSettingsDrawer,
  listenOnRootMixin,
  sidebarProps,
  prefixProps
} from 'fm-app-settings'

Vue.directive('f-toggle', FmToggleDirective)

import learnPlusAppSettingsMixin from './learnplus-app-settings-mixin'

export default {
  components: {
    FmAppSettingsButton,
    FmAppSettingsDrawer
  },
  mixins: [
    listenOnRootMixin,
    learnPlusAppSettingsMixin
  ],
  props: {
    ...prefixProps(sidebarProps, 'sidebar')
  },
  data() {
    return {
      settings: {}
    }
  },
  created() {
    this.listenOnRoot('fm:settings:state', this.onUpdate)
  },
  methods: {
    onUpdate(settings) {
      Object.keys(settings).map(key => {
        this.$set(this.settings, key, settings[key])
        this.applyConfig(key, settings[key])
      })
    },
    applyConfig(configKey, value) {
      let config = this.config[configKey]

      if (config === undefined) {
        return
      }

      if (typeof config === 'function') {
        return config.call(this, value)
      }

      this.applyElements(config[value])
    },
    applyElements(config) {
      if (config === undefined) {
        return
      }

      for (var selector in config) {
        if (config.hasOwnProperty(selector)) {
          var element = config[selector]
          var node = document.querySelector(selector)
          if (!node) {
            return
          }
          if (element.addClass) {
            element.addClass.forEach(className => {
              node.classList.add(className)
            })
          }
          if (element.removeClass) {
            element.removeClass.forEach(className => {
              node.classList.remove(className)
            })
          }
          if (element.src) {
            node.src = element.src
          }
        }
      }
    }
  }
}
</script>
