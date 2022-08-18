import 'jest'
import { mount } from '@vue/test-utils'
import Logo from '../../client/components/Logo.vue'

describe('Logo', () => {
  it('is a Vue instance', () => {
    const wrapper = mount(Logo)
    expect(wrapper.vm).toBeTruthy()
  })
})
