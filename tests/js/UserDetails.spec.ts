import 'jest'
import { shallowMount } from '@vue/test-utils'
import UserDetails from '../../client/components/resume/UserDetails.vue'

describe('User Profile', () => {
  it('shows fetching data while loading user', () => {
    const wrapper = shallowMount(UserDetails)
    expect(wrapper.text()).toContain('Fetching Data')
  })
})
