import type { GetterTree, ActionTree, MutationTree } from 'vuex'
import { Skill } from '@/types/api'

export interface RootState {
    skills: Skill[],
    addnewskill:Boolean
    editskill:Boolean
}

export const state = (): RootState => ({
  skills: [],
  addnewskill: false,
  editskill: false,
})

export const getters: GetterTree<RootState, RootState> = {
  getSkills: (state): Skill[] => state.skills,
}

export const mutations: MutationTree<RootState> = {
  setAddnewSkill: (state) => { state.addnewskill = !state.addnewskill },
  setEditSkill: (state) => { state.editskill = !state.editskill },
  setSkills: (state, skills:Skill[]) => {
    state.skills = skills
  },
}

export const actions: ActionTree<RootState, RootState> = {
  async updateSkills ({ commit }) {
    const skills = (await this.$axios.get('skills')).data.data as Skill[]
    commit('setSkills', skills)
  },
}
