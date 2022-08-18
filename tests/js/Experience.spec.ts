import 'jest'
import { mount } from '@vue/test-utils'
import Experience from '@/client/components/resume/Experience.vue'
import AddExperience from '@/client/components/resume/AddExperience.vue'
describe('User Profile', () => {
  it('shows fetching data while loading user', () => {
    const wrapper = mount(Experience)
    expect(wrapper.findComponent(AddExperience)).toBeTruthy()
  //  expect(wrapper.text()).toContain("Fetching Data")
  })
})
